@extends('layouts.master')


@section('main_content')

<div class="row">
 <div class="col-lg-8 col-lg-offset-1">
  <div class="panel panel-primary">
   <div class="panel-heading">Update Cource Outcomes</div>
     <div class="panel-body">

       <form method="POST" action="/co/{{$coursedata->id}}" class="form-horizontal" role="form">
    	 <input name="_method" type="hidden" value="PUT">

    	{{ csrf_field() }}

    	@foreach ($cos as $co) 
		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>{{$co->name}}</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" name="{{$co->id}}" cols="80" rows="4" required> {{$co->description }} </textarea >

				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>
		@endforeach


		<div class="form-group">
			 <button type="submit" class="btn btn-success btn-panel">Submit</button>
		</div>
	 </form>
    </div><!--end panel body-->
   </div><!--end panel-->
  </div><!--end col-->
 </div><!--end row-->
   
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

	
	

@endsection
