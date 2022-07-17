<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index(Request $request)
    {
        $ac = AcademicYear::orderBy('id','DESC')->paginate(10);
        return view('academic.index',compact('ac'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    public function create(Request $request)
    {
        $input = $request->all();
        if(AcademicYear::max('year') > 0) {
            $input['year'] = AcademicYear::max('year')+1; 
        } else {
            $input['year'] = 2018;
        }
        AcademicYear::create($input);
       return redirect()->route('majors.index');
    }

    public function store(Request $request)
    {
        request()->validate([
            'year' => 'required',
        ]);
        
        AcademicYear::create($request->all());
        return redirect()->route('academic_years.index')->with('success','Semester created successfully.');
    }

    public function destroy()
    {
        $maxYear = AcademicYear::max('year');
        $findId = DB::table('academic_years')->where('year', $maxYear)->pluck('id')[0];
        AcademicYear::find($findId)->delete();
        return redirect()->route('majors.index')
                        ->with('success','Academic Year deleted successfully');
    }

}
