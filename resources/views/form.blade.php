@extends('layouts.master')


@section('main_content')

<div class="row">
 <div class="col-lg-8 col-lg-offset-1">
  <div class="panel panel-primary">
   <div class="panel-heading">Define Cource Outcomes</div>
     <div class="panel-body">

       <form method="POST" action="/co/{{$coursedata->id}}" data-toggle="validator" class="form-horizontal" role="form">
    	{{ csrf_field() }}
    	@for ($i=1; $i<=6; $i++)
		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>{{$coursecode}}.{{$i}}</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" name="co{{$i}}"
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$"  value="{{ old('co1') }}" required></textarea >
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>
			</div>
		</div>
		@endfor


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

@section('add-script')
	
@endsection
