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
    
        //To discard or save uploaded csv file
        if($request->has('discard'))
        {
          upload::truncate();
          return view('upload');     

        }
        elseif ($request->has('save')) {
              echo '<script language="javascript">';
              echo 'alert("SUCCESFULLY SAVED!");';
              echo '</script>';
              return view('upload');
        } 

        $blank=true;

        //get file
        $upload=$request->file('upload-file');

        $filePath=$upload->getRealPath();
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
        
        //open and read


        $escapedHeader=[];
        
        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z0-9]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }

        //looping through other columns
        while($columns=fgetcsv($file))
        {
            if($columns[0]=="")
            {
                continue;
            }

           $data= array_combine($escapedHeader, $columns);
           
           //Displaying error if a blank field is found
           foreach ($data as $key => $value) {
             if ($value=="") {
               echo '<script language="javascript">';
               echo 'alert("BLANK FIELD AT '.$key.' FOR STUDENT '.$data['name'].' PLEASE UPLOAD A VALID CSV FILE");';
               echo "window.location.href= './upload';";
               echo '</script>';
               $blank=false;
               break;
             }
           }

           //blank field found... deleting all data....
           if (!$blank) {
             upload::truncate();
             break;
           }

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
       //To prevent deletion of temp file for displaying of csv
       move_uploaded_file($filePath, substr($filePath, 0,strlen($filePath)-4).'A.tmp');
       //To delete the copy of temp file
       unlink(substr($filePath, 0,strlen($filePath)-4).'A.tmp');
       return  view('display',['id'=>$filePath]);
    }


}
