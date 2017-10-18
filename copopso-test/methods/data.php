<?php
  /*
  FOR ARUN :
  OPEN THE JSON FILE "markks.json" and decode it using json_decode() to $marks

  $marks['assignment'] contains assignment marks and weightages. Same goes for test1 and test2

  $marks['assignment'][$i] gives the CO or marks of student $i + 1 [SAME FORMAT FOR test1 AND test2]

  Store average of all CO1's of assignment,test1 and test2 in 3 separate variables
  Do the same for all 6 CO's [blank value means CO value doesn't exist for that test/assignment.
  So make sure to check if the CO values are blank or not before calculating average]

  Finally, store averages of enabled CO's of assignment in the form (CO_average/weightage) in an Array
  Do the same for test1 and test2.
  Add all these values to another array called CIE and convert it into JSON format using json_encode().
  Create this json file as done in this script
  */
  
  $a = json_decode($_POST['assignment']); //Contains form data for assignment
  $t1 = json_decode($_POST['test1']);     //contains form data for test 1
  $t2 = json_decode($_POST['test2']);     //contains form data for test 2

  $assignment = [];
  $test1 = [];
  $test2 = [];

  //Storing weightages
  for ($i=0; $i < 6; $i++) {
    $assignment['weightage'][$a[$i]->name] = $a[$i]->value;
    $test1['weightage'][$t1[$i]->name] = $t1[$i]->value;
    $test2['weightage'][$t2[$i]->name] = $t2[$i]->value;
  }

  //STORING OF FORM DATA STARTS HERE
  $index=-1;

  foreach ($a as $key => $value) {
  # code...
    if($key<6)
      continue;
    if($key%6==0)
        $index++;
    $assignment[$index][$value->name] = $value->value;
    }

  $index=-1;

  foreach ($t1 as $key => $value) {
  # code...
    if($key<6)
      continue;
    if($key%6==0)
        $index++;
    $test1[$index][$value->name] = $value->value;
    }

  $index=-1;
  foreach ($t2 as $key => $value) {
    # code...
    if($key<6)
      continue;
    if($key%6==0)
        $index++;
    $test2[$index][$value->name] = $value->value;
    }
  //STORING OF FORM DATA ENDS HERE

  $marks = ["assignment"=>$assignment, "test1"=>$test1, "test2"=>$test2];

  //CREATING JSON FILE CONTAINING FORM DATA
  $fp = fopen('marks.json', 'w');
  fwrite($fp, json_encode($marks));
  fclose($fp);
?>
