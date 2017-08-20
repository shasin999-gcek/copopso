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
        return [$coursedata, $status, $cos];
      //  return view('co.index', compact('coursedata', 'status', 'cos'));
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

        $co_count = count($request->all());


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

        UserCourse::find($id)->update(["status" => 1]);

        $coursedata->co_count = $co_count;
        $coursedata->save();

        return $coursedata;
      //  Status::where('user_course_id', $id)->update(['co' => true]);

      //  return redirect(url('co/'.$id));

    }

    public function edit($id)
    {
        /*
            Function for editing  the CO DEFINITION form
            Accepts user_course_id as $id
            Returns the data belonging to that user_course,
            as well as the course_code of the associated course
         */

        //Check if the co has been defined first

        //Pass data

        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->orderBy('name')->get();
        return view('co.edit', compact('coursedata', 'cos'));
    }

    public function update(Request $request, $id)
    {
        // get new co_count
        $co_count = count($request->all());

        $course_data = UserCourse::find($id);
        $course_data->co_count = $co_count;   // update the new co_count
        $course_data->save();

        $course_code = $course_data->course->course_code;

        // TODO: Validaton


        for($i = 1; $i <= $co_count; $i++)
        {
          $update_co = Co::where('name', $course_code.".".$i)->first();
          // if the fetched data is null that means we want to add new Co to table (maybe co7..).
          if($update_co == null) {
            $new_co = array();
            $new_co['name'] = $course_code.".".$i;
            $new_co['user_course_id'] = $id;
            $new_co['description'] = request('co'.$i);
            Co::insert($new_co);
          } else {
            // otherwise update the row asusual
            $update_co->description = request('co'.$i);
            $update_co->save();
          }

        }

        return $course_data;
    }
}
