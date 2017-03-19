@extends('layouts.app')


@section('main_content')
<div class="row">
 <div class="col-lg-8 col-lg-offset-1">
  <div class="panel panel-primary">
   <div class="panel-heading">Define Cource Outcomes</div>
     <div class="panel-body">

      <form  class="form-horizontal" id="form1" role="form">
       <!--co1-->
		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...1</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" 
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>

		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...2</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" 
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>
			</div>
		</div>

		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...3</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" 
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>

		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...4</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" 
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>

		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...5</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" 
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>

		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4>2K16...6</h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" 
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$" required></textarea>
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>	
			</div>
		</div>

		<div class="form-group">
			 <button type="submit" id="input-co-btn" class="btn btn-success btn-panel">Submit</button>
		</div>
	 </form>
    </div><!--end panel body-->
   </div><!--end panel-->
  </div><!--end col-->
 </div><!--end row-->

@endsection

@section('script')
	<script type="text/javascript">
		
	    $('#form1').validator();
		
	</script>
@endsection