<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudyPlan;

class AssignController extends Controller
{
    public function index() {  
        $i = 0;
        $findStudyPlan = DB::table('study_plans')->where('studys_plan_group', 0)->whereNotNull('department')->get();
        return view('assign.index', compact('findStudyPlan', 'i'));
    }

    public function create() {
        $name = DB::table('study_plans')->where('studys_plan_group', 0)->whereNull('department')->pluck('name');
        $academic_year = DB::table('academic_years')->pluck('year');
        $major = DB::table('majors')->pluck('short_name');
        return view('assign.create', compact('name', 'major', 'academic_year'));
    }

    public function store(Request $request) {
            $this->validate($request, [
                //'group_name' => 'required',
                'name' => 'required',
                'department' => 'required',
                'academic_year' => 'required',
            ]);

            $input = $request->all();
            $input['group_name'] = 'Created';
            $findStudyPlanId = DB::table('study_plans')->where('name', $request->name)->where('studys_plan_group', 0)->where('department', NULL)->pluck('id')[0];
            $checking = DB::table('majors')->where('short_name', $input['department'])->pluck('id')->count();
            if ($checking > 0) {
                $findMajorId = DB::table('majors')->where('short_name', $input['department'])->pluck('id')[0];
            }
            $academic_year =  $request->academic_year;
            $changeCourse = DB::table('study_plans')->where('studys_plan_group', $findStudyPlanId)->pluck('id');

            foreach($changeCourse as $key => $item) {
                if (!is_null(StudyPlan::where('id', $item)->pluck('academic_year')[0])) {
                    StudyPlan::find($item)->replicate()->save();
                }
                StudyPlan::where('id', $item)->update(['majors_id' => $findMajorId]);
                StudyPlan::where('id', $item)->update(['academic_year' => $academic_year]);
            }  
            StudyPlan::create($input);
        
        
            return redirect()->route('assign.index')
                            ->with('success','Study Plan created successfully');
    }

    public function destroy(Request $request, $id) {
        //$findStudyPlanId = DB::table('study_plans')->where('name', $request->name)->where('studys_plan_group', 0)->where('department', NULL)->pluck('id')[0];
        $changeCourse = StudyPlan::find($id)->name;
        $checking = DB::table('study_plans')->where('name', $changeCourse)->where('department', NULL)->where('studys_plan_group', 0)->pluck('id');
        if ($checking->count() > 0) {
            $findChangeCourse = DB::table('study_plans')->where('name', $changeCourse)->where('department', NULL)->where('studys_plan_group', $checking[0])->pluck('id');
            //dump($findChangeCourse);
            foreach ($findChangeCourse as $item) {
                StudyPlan::where('id', $item)->update(['majors_id' => NULL]);
                StudyPlan::where('id', $item)->update(['academic_year' => NULL]);
            }
        }

        StudyPlan::find($id)->delete();


        //$studentCourse = DB::table('study_plans')->join('courses', 'study_plans.courses_id', '=', 'courses.id')->where('study_plans.majors_id', $userMajorID1)->where('study_plans.academic_year', $userAC)->get();
        //dump($checking);
        // StudyPlan::find($id)->delete();
        return redirect()->route('assign.index')
                        ->with('success','Study Plan deleted successfully');
    }

    public function edit($id)
    {
        $i = 0;
        $name = DB::table('study_plans')->where('studys_plan_group', 0)->whereNull('department')->pluck('name');
        $academic_year = DB::table('academic_years')->pluck('year');
        $major = DB::table('majors')->pluck('short_name');
        $studyPlan = StudyPlan::find($id);
        return view('assign.edit',compact('studyPlan', 'name', 'academic_year', 'major'));
    }

    public function update(Request $request, $id) {
        request()->validate([
            //'group_name' => 'required',
        ]);

        $input = $request->all();
        $majors = StudyPlan::find($id);
        $majors->update($input);
    
        return redirect()->route('assign.index')
                        ->with('success','Study Plan updated successfully');
    }
}   
