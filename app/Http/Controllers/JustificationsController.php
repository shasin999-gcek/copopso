<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\UserCourse;
use App\Co;
use App\Po;

class JustificationsController extends Controller
{

    public function store(Request $request, $id, $po_id)
    {

        /*
            Function for storing the PO JUSTIFICATIONS
            Accepts user_course_id as $id, the number of po/pso as $po_id, and
            request objects.

         */

        $coursedata = UserCourse::find($id);

        $cos = Co::where('user_course_id', $id)->get();

        //To store the justifications

        $justifications=array();
        foreach ($request->except('_token') as $co_id => $justification) {
            $codata=array();
            $codata["co_id"]=$co_id;
            $codata["po_id"]=$po_id;
            $codata["justification"]=$justification;
            $justifications[] = $codata;
        };

        DB::table('po_justifications')->insert($justifications);

        //Checking if PO or PSO, to get the column name for status

        if ($po_id>12)
        {
            $pso_id= $po_id-12;
            $po="pso".$pso_id;
        }
        else
        {
            $po="po".$po_id;
        }


        Status::where('user_course_id', $id)->update([$po => true]);


        //To redirect to next PO/PSO

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


}
