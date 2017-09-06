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

	public function create($id, $po_id)
    {
        /*
            Function for viewing the PO JUSTIFICATION form
            Accepts user_course_id as $id, the number of po/pso as $po_id

         */

        $coursedata = UserCourse::find($id);
        $cos = Co::where('user_course_id', $id)->get();

        //Checking if requested for PO or PSO

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

                //If the value is non-zero, store co_name, co_id and po_value in $codata
                $codata=array();
                $codata["name"]=$co->name;
								$codata["description"]=$co->description;
                $codata["id"]=$co->id;
                $codata["po_value"]=$co->copo->$po;
                $copo[] = $codata;


        };

        //If no value was assigned to PO, redirect to next one.

        if (empty($copo)){

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

        //To get the data associated with that PO:

        $podata = Po::find($po_id);

        return $copo;
    }



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
