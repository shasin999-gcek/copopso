<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\upload;

use App\Http\Requests;

class MarksController extends Controller
{
    //
     public function showForm()
    {
        return view('upload');
    }
    public function store(Request $request)
    {   
        //get file
        $upload=$request->file('upload-file');
        $filePath=$upload->getRealPath();
        
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
        

        $escapedHeader=[];
        
        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z0-9]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        //looping through othe columns
        while($columns=fgetcsv($file))
        {
            if($columns[0]=="")
            {
                continue;
            }

           $data= array_combine($escapedHeader, $columns);
           
           // Table update
           $rollno=$data['rollno'];
           $name=$data['name'];
           $t1=$data['t1'];
           $t2=$data['t2'];
           $a1=$data['a1'];
           $a2=$data['a2'];
           $i=$data['i'];
           $u=$data['u'];
           $Upload= upload::firstOrNew(['rollno'=>$rollno]);
           $Upload->name=$name;
           $Upload->t1=$t1;
           $Upload->t2=$t2;
           $Upload->a1=$a1;
           $Upload->a2=$a2;
           $Upload->i=$i;
           $Upload->u=$u;
           $Upload->save();
        }
        
        
    }
}
