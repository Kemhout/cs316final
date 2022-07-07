<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
      // $userrole = Auth::user()->getRoleName();
        //dump($userrole);
        $user = $request->user();
        dump($user->getRoleNames()[0]);
        $major = DB::table('users')->distinct()->get(['major']);
        $majorCount = User::pluck('major')->count()-1;
        $arrMajorCount = array();
        $arrMajorCountStudent = array();
        foreach($major as $key=> $item) {
            if($item->major != NULL) {
                $studentInMajor = DB::table('users')->where('major', $item->major)->count();
                $arrMajorCount[$key] = $item->major;
                $arrMajorCountStudent[$key] = $studentInMajor;
            }
        }
        return view('home', compact('arrMajorCount', 'arrMajorCountStudent', 'user'));
    }
}
