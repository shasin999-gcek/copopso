<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\UserCourse;
use App\Course;
use App\Co;
use App\Po;

class CoController extends Controller
{
    //To do: Code to check if user has access to page (to that user_course_id), else redirect
 
    public function index($id)
    {
        /*
            Function for viewing current status of all tasks and to edit+modify. 
            Accepts user_course_id as $id. 
            Returns the data belonging to that user_course as well as cos associated with it.
        */

        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->get();
        return view('co', compact('coursedata', 'cos'));
    }

    public function create($id)
    {   
        /* 
            Function for viewing the CO DEFINITION form
            Accepts user_course_id as $id 
            Returns the data belonging to that user_course, 
            as well as the course_code of the associated course
         */
        $coursedata = UserCourse::find($id);
        $course_id = $coursedata->course_id;
        $coursecode = Course::find($course_id)->course_code;
        return view('form', compact('coursedata', 'coursecode'));
    }

    
    public function store(Request $request, $id)
    {   
        /*
            Function for storing the CO DEFINITIONS
            Accepts user_course_id as $id, request objects.
            
        */

        //Since _token is also returned as request among other form fields, subtract 1 to get co_count. 
        //Alternately, try count($request->except(_token))

        $co_count = count($request->all())-1;
        

        $coursedata = UserCourse::find($id);
        $coursecode = $coursedata->course->course_code;
        
        //validation
            
        $conditions = array();
        for ($i=1; $i<=$co_count; $i++){
             $conditions["co$i"] = 'bail|required|string|max:400';
        }

        $validator = Validator::make($request->all(), $conditions);

        if ($validator->fails()) {
        return redirect('/')
                        ->withInput()
                        ->withErrors($validator);

        }
       
        //$row stores all the values for a row in table cos

        $rows = array();
        for ($i=1; $i<=$co_count; $i++){
            $row=array();
            $row["name"] = $coursecode.'.'.$i;
            $row["user_course_id"]= $id;
            $row["description"]=request("co$i");
            $rows[]=$row;
        }
        
        Co::insert($rows);
        
        //UserCourse::find($id)->update(["status" => 1]);

        $coursedata->co_count = $co_count;
        $coursedata->status = 1;
        $coursedata->save();

        

        return redirect(url('co/'.$id));

    }

    
}
