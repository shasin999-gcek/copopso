@extends('layouts.master')


@section('main_content')

   <div class="page-header" style="margin-top: 60px;">
     <h1 class="text-primary">Justification</h1>
     <h4 class="text-primary">PO{{$podata->id}}:: {{$podata->name}}</h4>
     <h6 class="text-primary">{{$podata->body}}</h4>
   </div>
   		<?php $po_id=$podata->id; ?>  
   		<!-- Check: for some reason, specifying $podata->id in route for action is buggy -->
   		<form class="form-vertical" role="form" method='POST' action='/co/storejust/{{$id}}/{{$podata->id}}'>
		{{ csrf_field() }}

		<table class="table">
		  
		  <thead class="thead-inverse">
			<tr>
				<th class="col-lg-2">CO</th>
				<th class="col-lg-2">Weightage for PO</th>
				<th class="col-lg-8">Reason for weightage given</th>
			</tr>
		   </thead>
		   
		  @foreach($copo as $codata)
			<tr>
				<th class="col-lg-2">{{$codata["name"]}}</th>
				<th class="col-lg-2">{{$codata["po_value"]}}</th>
				<th class="col-lg-8">
					<input class="form-control" type="text" name='{{$codata["id"]}}' cols="60" rows="4" pattern="^[_A-z0-9]{1,}$" required>
					

				</th>
			</tr>
		  @endforeach
			
		
			
			@if(count($errors))
			<div class="form-group">
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li> {{ $error }} </li>
						@endforeach
					</ul>
				</div>
			</div>
			@endif
		<button type="submit" class="btn btn-success" id="btn-submit">Submit</button>

	</form>
	

@endsection

@section('script')
	<script type="text/javascript">
		$(function() {
			$('#form').validate();
		});
	</script>
@endsection