<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserCourse;
use App\Course;
use App\Co;
use App\Po;

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
     * @return \Illuminate\Http\Response
     */
       public function index()
    {
        $user = Auth::User();
        $coursedata = $user->courses;
    
        return view('home', compact('coursedata'));
        
    }

    public function createweightage($id)
    {
        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->get();
        $co_count = $coursedata->co_count;


        return view('weightages', compact('id','cos', 'co_count'));

    }
}
