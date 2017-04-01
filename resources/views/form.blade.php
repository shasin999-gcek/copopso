@extends('layouts.master')


@section('main_content')

<div class="row">
 <div class="col-lg-8 col-lg-offset-1">
  <div class="panel panel-primary">
   <div class="panel-heading">Define Cource Outcomes</div>
     <div class="panel-body">

       <form method="POST" action="/copojust" data-toggle="validator" class="form-horizontal" role="form">
    	{{ csrf_field() }}
		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...1</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" name='co1'
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$"  value="{{ old('co1') }}" required></textarea >
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>

		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...2</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" name='co2'
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" value="{{ old('co2') }}" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>
		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...3</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" name='co3'
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$"  value="{{ old('co3') }}"required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>
		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...4</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" name='co4'
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" value="{{ old('co4') }}" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>
		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...5</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" name='co5'
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" value="{{ old('co5') }}" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>
		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...6</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" name='co6'
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" value="{{ old('co6') }}" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>
		<div class="form-group">
			 <button type="submit" class="btn btn-success btn-panel">Submit</button>
		</div9
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
	<script type="text/javascript">
		$(function() {
			$('#form1').validator();
		});
	</script>
@endsection