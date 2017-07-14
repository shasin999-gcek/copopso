<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\UserCourse;
use App\Co;



class WeightagesController extends Controller
{
    public function create($id)
    {
        /* 
            Function for viewing the WEIGHTAGES form
            Accepts user_course_id as $id.
          
         */

        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->get();
        $co_count = $coursedata->co_count;

        return view('weightages', compact('id','cos', 'co_count'));

    }

    public function store(Request $request, $id)
    {
        /* 
            Function for storing the WEIGHTAGES.
            Accepts user_course_id as $id, and
            request objects.
          
         */

        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->get();
        $co_count = $coursedata->co_count;

        //To store total weightage (first column)
        
        $weightage = array(
            "user_course_id"    => $id,
            "u"                 => request("u"),
            "t1"                => request("t1"),
            "t2"                => request("t2"),
            "i"                 => request("i"),
            "a1"                => request("a1"),
            "a2"                => request("a2"),
            "attendance"        => request("attendance")
        );
        DB::table('weightages')->insert($weightage);

        
        //To store co weightages
        
        $columns = ["u","t1","t2","i","a1","a2","attendance"];
        $rows = array();

        foreach ($cos as $co){
            $row=array();
            $co_id= $co->id;
            $row["co_id"]= $co_id;
            foreach ($columns as $column)
            {
                $value = request("co$co_id-$column");
                if ($value === '-')
                    $value=0;
                $row[$column] = $value;
            }
            
            $rows[]=$row;
        }
       
        DB::table('co_weightage')->insert($rows);
        $coursedata->status +=1;
        $coursedata->save();
        
        return redirect(url('co/'.$id));

    }
}
