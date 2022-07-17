<?php
    
namespace App\Http\Controllers;
    
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
    
class CourseController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $major = DB::table('majors')->pluck('short_name');
        $courses = Course::latest()->paginate(5);
        return view('courses.index',compact('courses', 'major'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $credit = array(3, 4);
        $typeOfCourse = array("F-KHStudies", "F-MathSciTech", "F-SocSci", "F-Eng", "F-Core", "GE");
        return view('courses.create', compact('typeOfCourse', 'credit', ));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'code_name' => 'required',
            'type_of_course' => 'required', 
            'credit' => 'required',
        ]);
    
        Course::create($request->all());

        return redirect()->route('courses.index')
                        ->with('success','Course created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Course $courses)
    {
        return view('courses.show',compact('courses'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $credit = array(3,4);
        $selectedID = Course::find($id)->type_of_course;
        $selectedCredit =  Course::find($id)->credit;
        $chooseTypeOfCourse = array("F-KHStudies", "F-MathSciTech", "F-SocSci", "F-Eng", "F-Core", "GE");
        $courses = Course::find($id);
        return view('courses.edit',compact('courses', 'chooseTypeOfCourse', 'selectedID', 'selectedCredit','credit'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         request()->validate([
            'name' => 'required',
            'code_name' => 'required',
            'credit' => 'required',
            'type_of_course' => 'required',
        ]);
        //$courses->update($request->all());
        $input = $request->all();
    
        $courses = Course::find($id);
        $courses->update($input);
    
        return redirect()->route('courses.index')
                        ->with('success','Course updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::find($id)->delete();
        return redirect()->route('courses.index')
                        ->with('success','Course deleted successfully');
    }

    public function mySearch(Request $request)
    {
        $i = 0;
    	if($request->has('search')){
    		$courses = Course::search($request->get('search'))->paginate(5);	
    	}else{
    		$courses = Course::latest()->paginate(5);
    	}
        return view('courses.index',compact('courses'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}