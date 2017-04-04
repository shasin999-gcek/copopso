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

   	@foreach($usercourse as $row)
    <tr>
    	<td>{{$row['year'] }}</td>
        <td>{{$row['name'] }}{{$row['code'] }}</td>
        <td>{{$row['branch'] }}</td>
        <td>{{$row['semester'] }}</td>
        <td>Incomplete</td>
        <td>
            <a href="/co">Edit</a> 
        </td>
    </tr>
	@endforeach

 </table>	    	

		
			
		
		
		
	

@endsection
