<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Major;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $semesters = Semester::orderBy('id','DESC')->paginate(10);
        return view('academic.index',compact('semesters'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    

    public function create(Request $request)
    {
       
        $input = $request->all();
        $input['id'] = DB::table('semesters')->count()+1;       
        Semester::create($input);
       return redirect()->route('majors.index');
    }

    public function store(Request $request)
    {
        request()->validate([
            'id' => 'required',
        ]);
        
        Semester::create($request->all());
        return redirect()->route('semesters.index')->with('success','Semester created successfully.');
    }

    public function destroy()
    {
        $deleteID = DB::table('semesters')->count();
        Semester::find($deleteID)->delete();
        return redirect()->route('majors.index')
                        ->with('success','Semester deleted successfully');
    }
}
