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
use App\Status;
use App\CoPo;

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
        $status = $coursedata->status;
        $cos = Co::where('user_course_id', $id)->orderBy('name')->get();

        //to return CO-PO-PSO matrix values

        foreach ($cos as $co) {
            $copopso= CoPo::where('co_id', $co->id)->first();

            //to convert 0 to -
            $copopso=$copopso->getAttributes();
            foreach ($copopso as $key => $value) {
                
                if ($key !== "co_id")
                {
                    if ($value === 0)
                    {
                        $copopso[$key] = "-";
                    }
                }
            }

            $co["popso"] = array_except($copopso,['co_id']);

        }

        return view('co.index', compact('coursedata', 'status', 'cos'));
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
        return view('co.create', compact('coursedata', 'coursecode'));
    }

    public function show($id)
    {
        /*
            Function for viewing current status of all tasks and to edit+modify. 
            Accepts user_course_id as $id. 
            Returns the data belonging to that user_course as well as cos associated with it.
        */

        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->get();
        return view('co.show', compact('cos'));
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
        return redirect(url('co/'.$id.'/create'))
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
        $coursedata->save();

        Status::where('user_course_id', $id)->update(['co' => true]);

        return redirect(url('co/'.$id));

    }

    public function edit($id)
    {   
        /* 
            Function for viewing the CO DEFINITION form
            Accepts user_course_id as $id 
            Returns the data belonging to that user_course, 
            as well as the course_code of the associated course
         */
        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->orderBy('name')->get();
        return view('co.edit', compact('coursedata', 'cos'));
    }

    public function update(Request $request, $id)
    {

        $coursedata = UserCourse::find($id);
        $cos=$coursedata->cos;
        
        //To do: validation

        //Updating each co

        foreach ($request->except('_method', '_token') as $co_id => $description)
        {
            $updated_co = Co::find($co_id);
            $updated_co->description = $description;
            $updated_co->save();
        }

        return redirect(url('co/'.$id));
    }
}
