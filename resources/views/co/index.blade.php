@extends('layouts.master')

@section('main_content')

	<div class="page-header" style="margin-top: 10px;">
		<h1 class="text-primary">Status</h1>
	</div>
	<hr>
	<h3 class="text-primary">Course Outcomes</h3>
	
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
		<h3 class="text-primary">CO-PO-PSO Mapping</h3>

		@if ($status->copopso)

			<table class="table">
		  <thead class="thead-inverse">
			<tr>
				<th></th>
				<th colspan="12">General PO</th>
				<th colspan="3">Dept PSO</th>
			</tr>
		   </thead>
		   <thead class="thead-inverse">
			<tr>
				<th>CO</th>
				<th>PO 1</th>
				<th>PO 2</th>
				<th>PO 3</th>
				<th>PO 4</th>
				<th>PO 5</th>
				<th>PO 6</th>
				<th>PO 7</th>
				<th>PO 8</th>
				<th>PO 9</th>
				<th>PO 10</th>
				<th>PO 11</th>
				<th>PO 12</th>
				<th class="text-danger">PSO 1</th>
				<th class="text-danger">PSO 2</th>
				<th class="text-danger">PSO 3</th>
				<th class="text-danger">PSO 4</th>
			</tr>
			</thead>

			@foreach ($cos as $co)
			<tr>
			   <th>{{$co->name}}</th>
				@for($i = 1; $i <= 12; $i++)
					<?php 
						$po = 'po'.$i;
						$value = $co["popso"][$po];
					?>
					<td>
					  <div class="form-group">
					    {{$value}}
					  </div>
					</td>			
				@endfor	
				@for($i = 1; $i <= 4; $i++)
					<?php 
						$pso = 'pso'.$i;
						$value = $co["popso"][$pso];
					?>
					<td>
					  <div class="form-group">
					    {{$value}}
					  </div>
					</td>			
				@endfor
			</tr>
			@endforeach
		</table>

			<a href="/co/{{$coursedata->id}}/editmap" class="btn btn-success btn-panel">Edit CO-PO-PSO values</a>

			<hr>

			<h3 class="text-primary">Enter PO Justifications</h3>
			<small> Section under construction. </small>
			<br><br>

			<a href="/co/{{$coursedata->id}}/po/1" class="btn btn-success btn-panel">Justify POS</a>


		@else

			<a href="/co/{{$coursedata->id}}/createmap" class="btn btn-success btn-panel">Map CO-PO-PSO</a>

			<hr>
			
			<h3 class="text-primary">Define CO Weightages</h3>

			@if ($status->weightage)

				<small>Weightages will be displayed here. </small>

			@else

				<a href="/co/{{$coursedata->id}}/weightage" class="btn btn-success btn-panel">Define </a>
	
			@endif

		@endif

	@else

		<a href="/co/{{$coursedata->id}}/create" class="btn btn-success btn-panel">Define COs</a>

	@endif

	<hr>

	<h3 class="text-primary">Upload Marklist</h3>

	<a href="/upload" class="btn btn-success btn-panel">Upload</a>

	<hr>
		
@endsection
	