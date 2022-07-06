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
     */
    function __construct()
    {
        //$this->middleware('permission:role-list');
        //$this->getRoleNames() == "Student";
        // $this->middleware('permission:role-create', ['only' => ['create','store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
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

        ];
        $list_type_of_course = DB::table('courses')->select('type_of_course')->distinct()->get();
        $list_type_of_course_count = array();
        foreach($list_type_of_course as $key => $item) {
            $list_type_of_course_count[$key] = DB::table('courses')->where('type_of_course', $item->type_of_course)->count();
        };
        $userId = $request->user()->id;
        $userMajor = User::find($userId)->major;
        $userAC = User::find($userId)->ac;
        $userMajorAc = $userMajor . ' ' . $userAC;
        $courseID = DB::table('student_group')->where('name', $userMajorAc)->get()[0]->id;
        $testing = DB::table('student_course')->join('courses', 'student_course.courses_id', '=', 'courses.id')->where('student_course.student_group_id', $courseID)->get();
        $testing2 = DB::table('student_course')->join('courses', 'student_course.courses_id', '=', 'courses.id')->where('student_course.student_group_id', 13)->get();
        $studentCourse = $testing->merge($testing2);
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles', 'userMajorAc', 'studentCourse', 'list_grade', 'list_type_of_course', 'list_type_of_course_count'))
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
            'require' => 'required',
        ]);
    
        Course::create($request->g);
    
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
        for($i=0; $i<count($request->require); $i++) {
            Course::where('id', $request->kk[$i])->update(['require' => $request->require[$i]]);
            Course::where('id', $request->kk[$i])->update(['studyOrNot' => 'Yes']);
        }
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
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

