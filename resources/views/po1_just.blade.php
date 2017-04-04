@extends('layouts.master')


@section('main_content')

   <div class="page-header" style="margin-top: 60px;">
     <h1 class="text-primary">Justification</h1>
     <h4 class="text-primary">PO1: Engineering Knowledge</h4>
   </div>
   
   
	    	

		<form class="form-vertical" id="co-po-matrix" role="form" method='POST' action='/po2just'>
		{{ csrf_field() }}

		<table class="table">
		  
		  <thead class="thead-inverse">
			<tr>
				<th class="col-lg-2">CO</th>
				<th class="col-lg-2">Weightage for PO</th>
				<th class="col-lg-8">Reason for weightage given</th>
			</tr>
		   </thead>
		   
		  @for($i = 1; $i <= 6; $i++)
			<tr>
				<th class="col-lg-2">2k16...{{$i}}</th>
				<th class="col-lg-2">1</th>
				<th class="col-lg-8">
				<input class="form-control" type="text" name="co$i-po1" cols="60" rows="4" pattern="^[_A-z0-9]{1,}$" required>
					
				</th>
			</tr>
		  @endfor
			
		
		
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

	</form>
	

@endsection

@section('script')
	<script type="text/javascript">
		$(function() {
			$('#form').validate();
		});
	</script>
@endsection