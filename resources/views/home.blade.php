@extends('layouts.master')


@section('main_content')

   <div class="page-header" style="margin-top: 60px;">
     <h1 class="text-primary">Courses</h1>
   </div>
   <table class='table'>
   <thead class="thead-inverse">
   <tr>
   		<th> Year </th>
   		<th> Course </th>
   		<th> Branch </th>
   		<th> Semester </th>
   		<th> Status </th>
   		<th> Action </th>
   	</tr>
   </thead>

   	@foreach($coursedata as $course)
    <tr>
    	<td>{{$course->pivot->academic_year }}</td>
        <td>{{$course['course_code'] }}</td>
        <td>{{$course->pivot->branch }}</td>
        <td>{{$course->pivot->semester}}</td>
        <td>Incomplete</td>
        <td>
            <a href="/co/{{ $course->pivot->id }}">View</a> 
        </td>
    </tr>
	@endforeach

 </table>	    	

@endsection
