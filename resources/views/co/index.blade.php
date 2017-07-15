@extends('layouts.master')

@section('main_content')

	<div class="page-header" style="margin-top: 10px;">
		<h1 class="text-primary">Status</h1>
	</div>
	<hr>
	<h4 class="text-primary">Course Outcomes</h3>
	
	@if ($status->co)

		<div class="row">
		 <div class="col-lg-8 col-lg-offset-1">
		 	<table class="table">
		      <thead class="thead-inverse">
		      	<tr>
		      		<th> CO </th>
		      		<th> Definition </th>
		      		
		      	</tr>
		      </thead>
		      <tbody>
		      	 @foreach($cos as $co)
			       <tr>
			       	<td>{{$co->name }}</td>
			        <td>{{$co->description }}</td>
			       </tr>
		   		 @endforeach 
		   		</tbody>
		   	  </table>  
		  </div><!--end col-->
		 </div><!--end row-->

		<a href="/co/{{$coursedata->id}}/edit" class="btn btn-success btn-panel">Edit COs</a>

		<hr>
		<h4 class="text-primary">CO-PO-PS0 Mapping</h3>

		@if ($status->copopso)

			<a href="/co/{{$coursedata->id}}/editmap" class="btn btn-success btn-panel">Edit CO-PO-PSO values</a>

		@else

			<a href="/co/{{$coursedata->id}}/createmap" class="btn btn-success btn-panel">Map CO-PO-PSO</a>
		
		@endif

	@else

		<a href="/co/{{$coursedata->id}}/create" class="btn btn-success btn-panel">Define COs</a>

	@endif


		
@endsection
	