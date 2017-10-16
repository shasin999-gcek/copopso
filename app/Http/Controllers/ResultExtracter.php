<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Log;
use DB;
use App\Results;

class ResultExtracter extends Controller
{
    public function store(Request $request)
    {
    	if($request->hasFile('results_pdf')) {

        // get complete filename with extension
    		$filenameWithExt = $request->file('results_pdf')
    							->getClientOriginalName();

        // get only filename
	    	$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
	    						
        // get only extension                    							
	    	$extension = $request->file('results_pdf')
	    							->getClientOriginalExtension();

        // convert it a another filename
	    	$filenameToStore = $filename.'_'.time().'.'.$extension;

        // store pdf file in temporary folder in storage dir
	    	$path = $request->file('results_pdf')
	    							->storeAs('temp', $filenameToStore);

        // get absolute file location
	    	$absPath = storage_path().'/app/'.$path;

        // create an instance of Pdf2Text
        $reader = new \Asika\Pdf2text;
    
        // convert pdf file to txt and store it as text.txt
        Storage::put('temp/text.txt', $reader->decode($absPath));

        // delete the pdf file no need for further processing
        Storage::delete('temp/'.$filenameToStore);

        function text($data)
        {
          for ($i=0; $i < count($data) ; $i++) {
            # code...
            $value = $data[$i];
            if(($value>='A' && $value<='Z') || ($value>='a' && $value<='z'))
              return FALSE;
          }

          return TRUE;
        }

        function format($grade)
        {
          $result = [];
          foreach ($grade as $key => $value) {
            list($course_code, $GRADE) = explode("(",$value);
            $result[$course_code] = rtrim($GRADE,")");
          }
          return $result;
        }


        $file = fopen(storage_path()."/app/temp/text.txt","r");
        $line = fgetcsv($file);
        $flag=1;
        $branches = [];
        $college = trim(fgetcsv($file)[0]);
        $results_meta = trim(fgetcsv($file)[0]);

        preg_match("(\d+\-\d+)", $results_meta, $match_out);

        if(count($match_out) == 0)
          return response("PDF file is not valid", 400)
                      ->header("Content-Type", "application/json");

        $academic_year = $match_out[0];

        preg_match("(S\d)", $results_meta, $match_out);
        $semester = $match_out[0];


        while($flag!=0)
        {

          while(($line != "Course Code") && 
            ($line = trim(fgetcsv($file)[0])) != "Course Code")
              $header = $line;
          

          $branches[$header] = [];
          //$courses = [];
          fgetcsv($file);

          while(($line = trim(fgetcsv($file)[0])) != "Register No")
          {
            if($line == "")
              continue;
            //$course_code = $line;
            while(($course_name = trim(fgetcsv($file)[0]))== "")
              continue;
            //array_push($courses,[$course_code => $course_name]);
          }


          fgetcsv($file);
          $result = [];

          while(($line = trim(fgetcsv($file)[0])) != "Course Code")
          {
            if($line=="")
              continue;
            else if(text($line)===TRUE)
            {
              $flag = 0;
              break;
            }

            $register_no = $line;
            while(True)
            {
              $grade = fgetcsv($file);
              if(trim($grade[0]) == "")
                continue;
              else if(trim($grade[0])!="Course Code")
              {
                $grade = format($grade);
                array_push($result,[$register_no => $grade]);
                break;
              }
              else {
                $line= "Course Code";
                break 2;
              }
            }
          }

          //$branches[$header]["COURSES"] = $courses;
          $branches[$header]["RESULT"] = $result;
          $header = $register_no;

        }
        //$b = "CIVIL ENGINEERING";
        //print_result($branches[$b]["RESULT"],$b);
        //print_r($branches);
        fclose($file);


        // grade points
        $formula = [
          "O"=>10,
          "A+"=>9,
          "A"=>8.5,
          "B+"=>8,
          "B"=>7,
          "C"=>6,
          "P"=>5,
          "F"=>0,
          "FE"=>0,
          "Absent"=>0
        ];

        // calculate average results
        function calculate($formula,$result) {
          $branch_avg = 0;
          $total_students = count($result);
          foreach ($result as $key => $students) {
            foreach ($students as $register_no => $courses) {
              $student_total = 0;
              foreach ($courses as $course_code => $grade) {
                $student_total+= $formula[$grade] * 9.5;
              }
              $branch_avg+=$student_total/count($courses);
            }
          }
          return $branch_avg/$total_students;
        }

        $SEE = [];

        function shorten($branch_name) {
          switch($branch_name) {
            case "CIVIL ENGINEERING":
              return "CE";
            case "COMPUTER SCIENCE":
              return "CSE";
            case "ELECTRICAL AND ELECTRONICS ENGINEERING":
              return "ECE";
            case "ELECTRONICS & COMMUNICATION ENGG":
              return "EEE";
            case "MECHANICAL ENGINEERING":
              return "ME";        
          }
        }

        foreach ($branches as $branch_name => $branch_content) {
          $SEE[shorten($branch_name)] = calculate($formula,$branch_content["RESULT"]);
        }


        if(Results::IsExists($academic_year, $semester)->count() == 0) {
          DB::table('results')->insert([
            "academic_year" => $academic_year,
            "semester" => $semester,
            "CE" => $SEE["CE"],
            "CSE" => $SEE["CSE"],
            "ECE" => $SEE["ECE"],
            "EEE" => $SEE["EEE"],
            "ME" => $SEE["ME"],
          ]);
        } else {
          return response("Result Already Exists", 400)
                      ->header("Content-Type", "application/json");
        }

    	} else {
    		return response("Uploading Error", 400)
                        -> header('Content-Type', 'application/json');
    	}

    }

    // get results
    public function show(Request $request)
    {

      $queryStings = $request->query();
      if(count($queryStings) == 2) {
        $academic_year = $queryStings["academic_year"];
        $semester = $queryStings["semester"];

        $result = Results::IsExists($academic_year, $semester)->first();
        if($result) {
          return $result->getAttributes();
        }
      }

      return Results::get()->all();

    }
}
