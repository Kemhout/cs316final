<?php

namespace App\Http\Controllers;

use App\Models\StudyPlan;
use App\Models\Course;
use App\Models\StudentGroup;
use App\Http\Requests\StoreStudyPlanRequest;
use App\Http\Requests\UpdateStudyPlanRequest;
use App\Models\StudentGroupCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeUnit\FunctionUnit;

class StudyPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function list_study_plan_index(Request $request) {
        $list_study_plan = DB::table('study_plans')->where('studys_plan_group', 0)->whereNull('department')->get();
        $i=0;
        //return view('study_plan.show', compact('list_study_plan', 'i'));
        return view('study_plan.show',compact('list_study_plan'))
        ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function edit_study_plan(Request $request, $id)
    {   
        $studyPlanName = StudyPlan::find($id)->name;
        $input = $request->all();
        //$list_course = DB::table('courses')->join('courses', )
        //dump($id);
        $list_course = DB::table('study_plans')->join('courses', 'study_plans.courses_id', '=', 'courses.id')->where('studys_plan_group', $id)->distinct()->paginate(10);
        $studyPlan = StudyPlan::orderBy('department','asc');
        $sth = DB::table('study_plans')->join('courses', 'study_plans.courses_id', '=', 'courses.id')->where('studys_plan_group', $id)->get()->unique('courses_id');
        return view('study_plan.index',compact('list_course', 'studyPlan', 'studyPlanName', 'id', 'sth'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $course = DB::table('courses')->pluck('code_name');
        $semester = DB::table('semesters')->pluck('id');
        $year_level = array('Freshman', 'Sophomore','Junior', 'Senior');

        return view('study_plan.create', compact('semester', 'course', 'year_level', 'id'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudyPlanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudyPlanRequest $request)
    {
        $this->validate($request, [
            //'courses_id' => 'required',
            'course' => 'required',
            'semester' => 'required',
            'year_level' => 'required',
        ]);

        $input = $request->all();
        $input['name'] = StudyPlan::find($request->studys_plan_group)->name;
        $courseID = DB::table('courses')->where('code_name', $input['course'])->get();
        $input['studys_plan_group'] = $request->studys_plan_group;
        $input['courses_id'] = $courseID[0]->id;

        $findDepartment = DB::table('study_plans')->where('studys_plan_group', $request->studys_plan_group)->pluck('majors_id');
        $academic_yearId = DB::table('study_plans')->where('studys_plan_group', $request->studys_plan_group)->pluck('academic_year');
        //dump($findDepartment->count());
        if($findDepartment->count() > 0) {
            $input['majors_id'] = $findDepartment[0];
            $input['academic_year'] = $academic_yearId[0];
        }
        // $studyPlanDepartment = $request['department'];
        // $studyPlanYearLevel = $request['year_level'];
        // StudentGroup::create(['name' =>  $studyPlanDepartment. ' '.$studyPlanYearLevel]);
        // $input['course_id'] = 1;
        // dump($studyPlanDepartment);
          //$user->assignRole($request->input('roles'));

        StudyPlan::create($input);        
        return redirect()->route('study_plans.edit_study_plan', [$request->studys_plan_group])
                        ->with('success','Study Plan created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudyPlan  $studyPlan
     * @return \Illuminate\Http\Response
     */
    public function show(StudyPlan $studyPlan)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudyPlan  $studyPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(StudyPlan $studyPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudyPlanRequest  $request
     * @param  \App\Models\StudyPlan  $studyPlan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudyPlanRequest $request, StudyPlan $studyPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudyPlan  $studyPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudyPlan::find($id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Study Plan deleted successfully');
    }

    public function autocomplete(Request $request)
    {
        $data = [];
  
        if($request->filled('q')){
        $data = Course::select("name", "id")
                        ->where('name', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();
        }
    
        return response()->json($data);
    }

    public function create_studys_plan() {
        $academic_year = DB::table('academic_years')->pluck('year');
        $major = DB::table('majors')->pluck('short_name');
        return view('study_plan\create_study_plan', compact('academic_year', 'major'));
    }

    public function store_study_plan(Request $request) {
        {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $input = $request->all();
           // $input['name'] = 'CS';
            StudyPlan::create($input);
            //dump($input); 
        //$user->assignRole($request->input('roles'));
        
            return redirect()->route('study_plans.list_study_plan_index')
                            ->with('success','Study Plan created successfully');
        }
    }

    public function destroy_study_plan(Request $request, $id) {
        StudyPlan::find($id)->delete();

        return redirect()->route('study_plans.list_study_plan_index')
        ->with('success','Study Plan Delete successfully');
    }

    public function assign_study_plan(Request $request, $id) {
        $academic_year = DB::table('academic_years')->pluck('year');
        $major = DB::table('majors')->pluck('short_name');
        return view('study_plan.assign_study_plan', compact('id', 'academic_year', 'major'));
    }

    public function assign_store_study_plan(Request $request, $id) {

        $input = $request->all();
        $findMajorId = DB::table('majors')->where('short_name', $input['department'])->pluck('id')[0];
        $academic_year =  $request->academic_year;
        $this->validate($request, [
            'department' => 'required',
            'academic_year' => 'required',
        ]);
        $changeCourse = DB::table('study_plans')->where('studys_plan_group', $id)->pluck('id');
        foreach($changeCourse as $key => $item) {
           StudyPlan::where('id', $item)->update(['majors_id' => $findMajorId]);
           StudyPlan::where('id', $item)->update(['academic_year' => $academic_year]);
        }   
        
        // dump($id);
        // dump($changeCourse);
    }

}
