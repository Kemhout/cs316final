<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Semester;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $semesters = Semester::orderBy('id','DESC')->paginate(10);
        $major = Major::orderBy('full_name','DESC')->paginate(10);
        $ac = AcademicYear::orderBy('id','DESC')->paginate(10);
        return view('academic.index',compact('major', 'semesters', 'ac'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('academic.major_create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMajorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            //'full_name' => 'required',
            //'short_name' => 'required',
        ]);
    
        Major::create($request->all());
        return redirect()->route('majors.index')
                        ->with('success','Major created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $majors = Major::find($id);
        return view('academic.major_edit',compact('majors',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMajorRequest  $request
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
           'full_name' => 'required',
           'short_name' => 'required',
       ]);

       $input = $request->all();
       $majors = Major::find($id);
       $majors->update($input);
   
       return redirect()->route('majors.index')
                       ->with('success','Major updated successfully');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Major::find($id)->delete();
        return redirect()->route('majors.index')
                        ->with('success','Major deleted successfully');
    }
}
