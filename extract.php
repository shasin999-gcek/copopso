<?php

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
      $result[trim($course_code)] = trim(rtrim($GRADE,")"));
    }
    return $result;
  }

  function print_result($result,$b)
  {
    echo '<p align="center">'.$b."</p>";
    echo "<br><br>".'<p align="center">'."RESULT"."</p><br><br>";
    foreach ($result as $key => $students) {
      foreach ($students as $register_no => $courses) {
        echo $register_no .'<br>';

        foreach ($courses as $course_code => $grade) {
          echo $course_code . " ==> " . $grade . "<br>";
        }
        echo "<br><br><br>";
      }
    }

  }

  $file = fopen("text.txt","r");
  $line = fgetcsv($file);
  $flag=1;
  $branches = [];
  while($flag!=0)
  {
    while(($line != "Course Code") && ($line = trim(fgetcsv($file)[0])) != "Course Code")
    {
      $header = $line;
    }

    $branches[$header] = [];
    $courses = [];

    fgetcsv($file);

    while(($line = trim(fgetcsv($file)[0])) != "Register No")
    {
      if($line == "")
        continue;
      $course_code = $line;
      while(($course_name = trim(fgetcsv($file)[0]))== "")
        continue;
      //array_push($courses,[$course_code => $course_name]);
      $courses[$course_code] = $course_name;
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

    $branches[$header]["COURSES"] = $courses;
    $branches[$header]["RESULT"] = $result;
    $header = $register_no;

  }
  //$b = "CIVIL ENGINEERING";
  //print_result($branches[$b]["RESULT"],$b);
  //print_r($branches);
  fclose($file);



  $formula = array("O"=>10,
                   "A+"=>9,
                   "A"=>8.5,
                   "B+"=>8,
                   "B"=>7,
                   "C"=>6,
                   "P"=>5,
                   "F"=>0,
                   "FE"=>0,
                   "Absent"=>0
                 );


  function calculate($formula,$course_names,$result)
  {
    $course_see = [];
    $total_students = count($result);
    foreach ($result as $key => $students) {
      foreach ($students as $register_no => $courses) {
        $student_total = 0;
        foreach ($courses as $course_code => $grade) {
          //print_r($course_code);
          // echo "<br><br>";
          // break;
          if(!isset($course_see[$course_names[$course_code]])){
            $course_see[$course_names[$course_code]] = 0;
          }

          else {
            $course_see[$course_names[$course_code]]+= ($formula[$grade] * 9.5 ) / $total_students;
          }
        }
      }
    }
    return $course_see;
  }

  $SEE = [];


  foreach ($branches as $branch_name => $branch_content) {
    $SEE[$branch_name] = calculate($formula,$branch_content["COURSES"],$branch_content["RESULT"]);

  }
  //print_r($branches["ELECTRICAL AND ELECTRONICS ENGINEERING"]["COURSES"]);
  print_r($SEE);
?>
