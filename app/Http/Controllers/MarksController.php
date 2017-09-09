<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
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
          return redirect()->back();    

        }
        /*elseif ($request->has('save')) {
              session()->flash('danger', "Some error occured");
              return redirect()->back();
        } */

        //get file

        $upload=$request->file('upload-file');
        
        /*if (!$upload) {
          session()->flash('danger', "PLEASE SELECT A FILE");
          return redirect()->back();
        }

        $validator = Validator::make(['file'=>$upload,'extension'=>strtolower($upload->getClientOriginalExtension()),],['file'=>'required','extension'=>'required|in:csv',]);
        
        if ($validator->fails()) {
          session()->flash('danger', "INVALID FILE!!");
          return redirect()->back();          
        }  
        */

        $filePath=$upload->getRealPath();
        $file=fopen($filePath, 'r');

        
        $header1= fgetcsv($file);
        $header2 =fgetcsv($file);
        $header = array_replace($header1,array(0 => $header2[0] , 1 => $header2[1]));
        
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
                //dd("hi");
                continue;
            }

           $data= array_combine($escapedHeader, $columns);
           
           //Displaying error if a blank field is found
           /*foreach ($data as $key => $value) {
             if ($value=="") {
               $message = 'BLANK FIELD AT ' . $key . ' FOR STUDENT ' . $data['name'] . '. PLEASE UPLOAD A VALID CSV FILE';
               //blank field found.... deleting all data
               upload::truncate();
               session()->flash('danger',$message);
               return redirect()->back();
             }
           }*/

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
       //move_uploaded_file($filePath, substr($filePath, 0,strlen($filePath)-4).'A.tmp');
       //To delete the copy of temp file
       
       //if(file_exists($filePath)){
        //    unlink($filePath);
       //}    
       //unlink(substr($filePath, 0,strlen($filePath)-4).'A.tmp');
       //$filePath = substr($filePath, 0,strlen($filePath)-4).'A.tmp';
       //return  view('display',['id'=>$filePath]);
      session()->flash('success', "Successfully uploaded!!");
      return redirect()->back();
    }


}
