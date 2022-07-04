<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
//use App\Http\Controllers\Auth;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();
        //dump($userInfo);
        $major = DB::table('users')->distinct()->get(['major']);
        $majorCount = User::pluck('major')->count()-1;
        $cs_student = DB::table('users')->where('major', 'CS')->count();
        foreach($major as $item) {
            if($item->major != NULL) {
                $studentInMajor = DB::table('users')->where('major', $item->major)->count();
                $arrMajorCount[] = $item->major;
                $arrMajorCountStudent[] = $studentInMajor;
            }
        }
        return view('home', compact('arrMajorCount', 'arrMajorCountStudent', 'user'));
    }
}