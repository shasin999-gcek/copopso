<?php
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////             													 
$marks = json_decode(file_get_contents('marks.json'), true);         //reading data from file and decoding the json to an array
$nos=sizeof($marks['assignment']) -1 ;                               //number of students in the class
$CIE=[];                                                             //initilization of final array                    
$assignment=[];														 //and subarrays of 
$test1=[];                                                           //the final
$test2=[];                                                           //array
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
foreach($marks['assignment']['weightage'] as $key => $value)         //setting array $assignment
{																	 //for each CO in the array
	if ($key=='weightage'){continue;}								 //to skip the first array ie weightage
	$sum=0;															 //temporary variable sum
	for ($i=0;$i<$nos;$i++)											 //to traverse through the number of students
	{
		if($marks['assignment']['weightage'][$key]!=0)				 //to check if the wightage is not zero.
		{
			$sum=$sum+$marks['assignment'][$i][$key];				 //adding up the values/marks of each student
		}
	}																 //assigning the array.!! the other sections following this(test1 and test 2 are similar to assignment)
	$assignment[$key]=array((string)($sum/$nos)=>(string)$marks['assignment']['weightage'][$key]);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
foreach($marks['test1']['weightage'] as $key => $value)				 //setting the array $test1
{
	if ($key=='weightage'){continue;}
	$sum=0;
	for ($i=0;$i<$nos;$i++)
	{
		if($marks['test1']['weightage'][$key]!=0)
		{
			$sum=$sum+$marks['test1'][$i][$key];
		}
	}
	$test1[$key]=array((string)($sum/$nos)=>(string)$marks['test1']['weightage'][$key]);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
foreach($marks['test2']['weightage'] as $key => $value)				 //setting the array $test1
{
	if ($key=='weightage'){continue;}
	$sum=0;
	for ($i=0;$i<$nos;$i++)
	{
		if($marks['test2']['weightage'][$key]!=0)
		{
			$sum=$sum+$marks['test2'][$i][$key];
		}
	}
	$test2[$key]=array((string)($sum/$nos)=>(string)$marks['test2']['weightage'][$key]);
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$CIE['assignment']=$assignment;										 //creating the array $CIE
$CIE['test1']=$test1;
$CIE['test2']=$test2;
$fp = fopen('average.json', 'w');									 //writing it to the file named average.json
fwrite($fp, json_encode($CIE));
fclose($fp);														 //NB all contents in the array are strings
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>