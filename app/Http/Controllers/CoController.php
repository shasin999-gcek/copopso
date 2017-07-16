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


    public function index($id)
    {
        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->get();
        return [$coursedata, $cos];
    }

    public function create($id)
    {
        //To do: Code to check if user has access to page, else redirect
        $coursedata = UserCourse::find($id);
        $course_id = $coursedata->course_id;
        $coursecode = Course::find($course_id)->course_code;
        return view('form', compact('coursedata', 'coursecode'));
    }


    public function store(Request $request, $id)
    {
        //Since _token is also returned as request among other form fields, subtract 1

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

        //dd(request()->all());  //gives JSON
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

    public function createpopso($id)
    {

        //To do: Code to check if user has access to page, else redirect
        $cos = Co::where('user_course_id', $id)->get();
        return view('co_po_matrix', compact('id', 'cos'));
    }

    public function storepopso(Request $request, $id)
    {
        $cos = Co::where('user_course_id', $id)->get();
        $coursedata =UserCourse::find($id);
        $co_count = $coursedata->co_count;

        $matrix = array();
        foreach ($cos as $co){
            $values=array();
            $co_id= $co->id;
            $values["co_id"]= $co_id;
            for ($j=1; $j<=12; $j++){
                $level = request("co$co_id-po$j");
                if ($level === '-')
                    $level=0;
                $values["po$j"] = $level;
            }
            for ($j=1; $j<=4; $j++){
                $level = request("co$co_id-pso$j");
                if ($level === '-')
                    $level=0;
                $values["pso$j"] = $level;
            }
            $matrix[]=$values;

        }

        DB::table('co_po')->insert($matrix);
        $coursedata->status = 2;
        $coursedata->save();

        return redirect(url('co/'.$id));
    }


    public function view($id, $po_id)
    {

        $coursedata = UserCourse::find($id);
        $podata = Po::find($po_id);
        $cos = Co::where('user_course_id', $id)->get();
        if ($po_id>12)
        {
            $pso_id= $po_id-12;
            $po="pso".$pso_id;
        }
        else
        {
            $po="po".$po_id;
        }

        $copo=array();
        foreach ($cos as $co) {
            if ($co->copo->$po != 0)
            {
                $codata=array();
                $codata["name"]=$co->name;
                $codata["id"]=$co->id;
                $codata["po_value"]=$co->copo->$po;
                $copo[] = $codata;
            }

        };
        return view('po_justifications', compact('id','copo', 'podata'));
    }



    public function storejust(Request $request, $id, $po_id)
    {
        $coursedata = UserCourse::find($id);

        $cos = Co::where('user_course_id', $id)->get();

        $justifications=array();
        foreach ($request->except('_token') as $co_id => $justification) {
            $codata=array();
            $codata["co_id"]=$co_id;
            $codata["po_id"]=$po_id;
            $codata["justification"]=$justification;
            $justifications[] = $codata;
        };


        DB::table('po_justifications')->insert($justifications);
        $coursedata->status += 1;
        $coursedata->save();
        if ($po_id<=15)
        {
            $po_id+=1;
            return redirect(url('co/po/'.$id.'/'.$po_id));
        }
        else
        {
            return redirect(url('co/'.$id));
        }

    }


    public function createweightage($id)
    {

        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->get();
        $co_count = $coursedata->co_count;

        return view('weightages', compact('id','cos', 'co_count'));

    }

    public function storeweightage(Request $request, $id)
    {

        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->get();
        $co_count = $coursedata->co_count;

        //WEIGHTAGE MATRIX
        //Can't accept '-' as there's no checking involved, so only accept 0 or do checking for each case
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
