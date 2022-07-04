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
     */
    function __construct()
    {
        //  $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:product-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->paginate(5);
        return view('courses.index',compact('courses'))
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
        $chooseMajor = DB::table('student_group')->name;
        $typeOfCourse = array("F-KHStudies", "F-MathSciTech", "F-SocSci", "F-Eng", "F-Core", "GE");
        return view('courses.create', compact('typeOfCourse', 'credit', 'chooseMajor'));
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
            'professor' => 'required',
            'type_of_course' => 'required', 
            'credit' => 'required',
            'department' => 'required',
        ]);
    
        Course::create($request->all());
        // $input = $request->all();
        // $input['cat'] = json_encode($input['cat']);
        // dump($input);
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
        $chooseMajor = array("CS", "MIS", "BUS");
        $courses = Course::find($id);
        return view('courses.edit',compact('courses', 'chooseTypeOfCourse', 'selectedID', 'selectedCredit', 'chooseMajor','credit'));
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
            'professor' => 'required',
            'credit' => 'required',
            'department' => 'required',
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
}