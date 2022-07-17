<?php
    
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\Course;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use App\Exports\UserCourseExport;
use Maatwebsite\Excel\Facades\Excel;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list_grade = [
            [
                'letterGrade' => 'AA',
                'numberGrade' => 4.0,
            ],
            [
                'letterGrade' => 'BA',
                'numberGrade' => 3.5,
            ],
            [
                'letterGrade' => 'BB',
                'numberGrade' => 3.0,
            ],
            [
                'letterGrade' => 'CB',
                'numberGrade' => 2.5,
            ],
            [
                'letterGrade' => 'CC',
                'numberGrade' => 2.0,
            ],
            [
                'letterGrade' => 'DC',
                'numberGrade' => 1.5,
            ],
            [
                'letterGrade' => 'DD',
                'numberGrade' => 1.0,
            ],
            [
                'letterGrade' => 'F',
                'numberGrade' => 0,
            ],
            [
                'letterGrade' => 'NP',
                'numberGrade' => 0,
            ],
        ];

        

        // foreach($list_type_of_course as $key => $item) {
        //     $list_type_of_course_count[$key] = DB::table('courses')->where('type_of_course', $item->type_of_course)->count();
        // };
        $semester = DB::table('semesters')->pluck('id')->last();
        $fail_course = DB::table('courses')->where('grade', 0)->get();
        //Searching Student Attribute
        $userId = $request->user()->id;
        $userMajor = User::find($userId)->major;
        $userAC = User::find($userId)->academic_year;
        $userMajorID1 = DB::table('majors')->where('short_name', $userMajor)->first()->id;
        //$userMajorID2 = DB::table('majors')->where('short_name', 'All')->first()->id;

        //Merge Student Course
        $studentCourse = DB::table('study_plans')->join('courses', 'study_plans.courses_id', '=', 'courses.id')->where('study_plans.majors_id', $userMajorID1)->where('study_plans.academic_year', $userAC)->get()->unique('courses_id');
        //$testing2 = DB::table('study_plans')->join('courses', 'study_plans.courses_id', '=', 'courses.id')->where('study_plans.majors_id', $userMajorID2)->where('study_plans.academic_year', $userAC);
        //$studentCourse = $testing->get()->merge($testing2->get());
    
        //Count type of course
        $list_type_of_course = array_unique($studentCourse->pluck('type_of_course')->toArray());
        $list_type_of_course_count = array();
        foreach($list_type_of_course as $key => $item) {
            $list_type_of_course_count[$key] = $studentCourse->where('type_of_course', $item)->count();
        };
        
        //Limit Input Grade
        $userYearLevel = User::find($userId)->year_level;
        switch ($userYearLevel) {
            case 'Freshman':
                $inputGrade = 2;
                break;
            case 'Sophomore':
                $inputGrade = 4;
                break;
            case 'Junior':
                $inputGrade = 6;
                break;
            case 'Senior':
                $inputGrade = 8;
                break;
        }
        $roles = Role::orderBy('id','DESC')->paginate(5);

        return view('roles.index',compact('roles', 'studentCourse', 'list_grade', 'list_type_of_course', 'list_type_of_course_count', 'fail_course', 'semester','inputGrade' ))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $permission = Permission::get();
    //     return view('roles.create',compact('permission'));
    // }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            // 'id' => 'required',
            'grade' => 'required',
            //'studyOrNot' => 'required'
        ]);
    
        Course::create($request->grade);
        dump('10');
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        for($i=0; $i<count($request->grade); $i++) {
            Course::where('id', $request->course_id[$i])->update(['grade' => $request->grade[$i],
                                                'studyOrNot' => 'Yes']);
            //Course::where('id', $request->course_idp[$i])->update([]);
        }
        
        return redirect()->route('roles.index')
                        ->with('success','Grade updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }

    public function export() 
    {
        return Excel::download(new UserCourseExport(2), 'course.xlsx');
    }
}

