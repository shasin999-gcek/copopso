<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\UserCourse;
use App\Co;
use App\CoPo;

class CoPoPsoController extends Controller
{

    public function store(Request $request, $id)
    {
        /*
            Function for storing the CO-PO-PSO matrix
            Accepts user_course_id as $id, request objects.

        */

        $cos = Co::where('user_course_id', $id)->get();

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

        // update the form status to 2 (ie copopso mapping is completed)
        $update = UserCourse::find($id);
        $update->status = 2;
        $update->save();

        return $matrix;
    }


    public function update(Request $request, $id)
    {
        /*
            Function for updating the CO-PO-PSO matrix
            Accepts user_course_id as $id, request objects.
        */

        $cos = Co::where('user_course_id', $id)->get();

        //Each row is stored in the associative array $values
        //Each row is stored in the array $matrix

        foreach ($cos as $co){
            $co_id= $co->id;
            $values=array();
            for ($j=1; $j<=12; $j++){

                $po = 'po'.$j;
                $value = request("co$co_id-$po");
                if ($value === '-')
                    $value = 0;
                $values[$po] = $value;
            }
            for ($j=1; $j<=4; $j++){
                $pso = 'pso'.$j;
                $value = request("co$co_id-$pso");
                if ($value === '-')
                    $value = 0;
                $values[$pso] = $value;
            }
            CoPo::where('co_id', $co_id)->update($values);

        }

        return $cos;
    }
}
