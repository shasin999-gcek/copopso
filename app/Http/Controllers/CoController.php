<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class CoController extends Controller
{
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //validation
            
            $conditions = array();
            for ($i=1; $i<=6; $i++){
                 $conditions["co$i"] = 'bail|required|string|min:2|max:400';
            }

            $validator = Validator::make($request->all(), $conditions);

            if ($validator->fails()) {
            return redirect('/')
                            ->withInput()
                            ->withErrors($validator);

                                     
        }



        //dd(request()->all());  //gives JSON
        $values = array();
        for ($i=1; $i<=6; $i++){
            $values["co$i"] = request("co$i");
        }
      

        DB::table('cotest')->insert($values);

        return view('co_po_matrix');

    }

    
    public function storecopo(Request $request)
    {
        $matrix = array();
        for ($i=1; $i<=6; $i++){
            $values=array();
            $values["co"]="co$i";
            for ($j=1; $j<=12; $j++){
                $level = request("co$i-po$j");
                if ($level === '-')
                    $level=0;
                $values["po$j"] = $level;
            }
            for ($j=13; $j<=15; $j++){
                $level = request("co$i-po$j");
                if ($level === '-')
                    $level=0;
                $values["pso$j"] = $level;
            }
            $matrix[]=$values;
            
        }
       

        DB::table('co_po')->insert($matrix);
        
        echo "success!";
    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
