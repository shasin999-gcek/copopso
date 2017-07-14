<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\UserCourse;
use App\Co;

class CoPoPsoController extends Controller
{
    //To do: Code to check if user has access to page, else redirect

    public function create($id)
    {   
        /* 
            Function for viewing the CO-PO-PSO matrix
            Accepts user_course_id as $id 
            Returns the COs associated with it.
         */

        $cos = Co::where('user_course_id', $id)->get();
        return view('co_po_matrix', compact('id', 'cos'));
    }

    public function store(Request $request, $id)
    {   
        /*
            Function for storing the CO-PO-PSO matrix
            Accepts user_course_id as $id, request objects.
            
        */

        $cos = Co::where('user_course_id', $id)->get();
        $coursedata =UserCourse::find($id);
        $co_count = $coursedata->co_count;
    

        //Each row is stored in the associative array $values
        //Each row is stored in the array $matrix

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

}
