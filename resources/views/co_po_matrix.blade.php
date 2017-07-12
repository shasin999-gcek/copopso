@extends('layouts.master')
    @section('main_content')

		<!--Second form starts here ...form type the action to be done on form of CO-PO mapping Outcome-->

		<form class="form-vertical" id="co-po-matrix" data-toggle="validator"
    role="form" action="/co/popso/{{$id}}" method="POST">
		{{ csrf_field() }}
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
			</tr>
			</thead>

			@foreach ($cos as $co)
			<tr>
			   <th>{{$co->name}}</th>
				@for($i = 1; $i <= 12; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co{{$co->id}}-po{{$i}}" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>
				@endfor
				@for($i = 1; $i <= 4; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co{{$co->id}}-pso{{$i}}" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>
				@endfor
			</tr>
			@endforeach
		</table>
		<div class="row">
	      <input class="col-lg-1" type="checkbox" id="check_id">
		  <p class="text-danger">
		     Check this box if you wanted to add hypen (-) in blank fields.
		  </p>
		</div>
      <button type="submit" class="btn btn-success" id="btn-submit">Submit</button>
	</form>





@endsection

@section('add-script')
<script type="text/javascript">
 
  	$('#check_id').change(function() {
  		if(this.checked) {
  		   var emptyFields = $('input:text').filter(function() {
  		     return this.value === "";
  		   });
  		   emptyFields.each(function() {
 			 $(this).val('-');
  		   });
  		   $('.text-danger').removeClass('text-danger').addClass('text-success');
  		} else {
  		   var fieldsWithHypen = $('input:text').filter(function() {
              return this.value == '-';
  		   });
           fieldsWithHypen.each(function() {
 			  $(this).val('');
  		   });
  		   $('.text-success').removeClass('text-success').addClass('text-danger');
  		}
  	});

});
</script>

@endsection
