@extends('layouts.app')
    @section('main_content')
		<h3>CO-PO Mapping Matrix</h3><br>
		<!--Second form starts here ...form type the action to be done on form of CO-PO mapping Outcome-->

		<form class="form-vertical" id="co-po-matrix" role="form">
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
				<th>PSO 1</th>
				<th>PSO 2</th>
				<th>PSO 3</th>
			</tr>
			</thead>

			<!--creating form dynamically-->
			<tr>
			   <th>2k16...1</th>
				@for($i = 1; $i <= 15; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co1-po{{$i}}" size="5" pattern="[1-3]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>2k16...2</th>
				@for($i = 1; $i <= 15; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co2-po{{$i}}" size="5" pattern="[1-3]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>2k16...3</th>
				@for($i = 1; $i <= 15; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co3-po{{$i}}" size="5" pattern="[1-3]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>2k16...4</th>
				@for($i = 1; $i <= 15; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co4-po{{$i}}" size="5" pattern="[1-3]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>2k16...5</th>
				@for($i = 1; $i <= 15; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co5-po{{$i}}" size="5" pattern="[1-3]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>2k16...6</th>
			@for($i = 1; $i <= 15; $i++)
				<td>
				  <div class="form-group">
				    <input class="form-control" type="text" name="co6-po{{$i}}" size="5"  pattern="[1-3]" required>
				  </div>
				</td>			
			@endfor	
			</tr>
		</table>
		<div class="row">
	      <input class="col-lg-1" type="checkbox" id="check_id">	
		  <p class="text-danger">
		     check this box if you wanted to add hypen (-) in blank fields.
		  </p>
		</div>
      <button type="submit" class="btn btn-success">Submit</button>
	</form>



@endsection				

@section('script')
<script type="text/javascript">
  
  $('#co-po-matrix').validator().on('submit', function (e) {
	  if (e.isDefaultPrevented()) {
	    // handle the invalid form...  
	  } else {
	    // everything looks good!
	  }
  });

  $(document).ready(function() {
  	var emptyFields = $('input:text').filter(function() { return this.value === ""; });
  	console.log(emptyFields);
  });
</script>

@endsection