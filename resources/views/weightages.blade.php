@extends('layouts.master')
    @section('main_content')
		
	

		<form class="form-vertical"role="form" action="/co/{{$id}}/weightage" method="POST">
		{{ csrf_field() }}
		<table class="table">
		  <thead class="thead-inverse">
			<tr>
				<th></th>
				<th >Weightage</th>

				@for ($i=1; $i<=$co_count; $i++)
					<th>CO{{$i}}</th>
				@endfor
			</tr>
		   </thead>
		   
			<tr>
			   <th>University</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="u" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>	
				@foreach ($cos as $co)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co{{$co->id}}-u" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>			
				@endforeach
				
			</tr>
			
			<tr>
			   <th>Series 1</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="t1" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>	
				@foreach ($cos as $co)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co{{$co->id}}-t1" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>			
				@endforeach
				
			</tr>

			<tr>
			   <th>Series 2</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="t2" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>	
				@foreach ($cos as $co)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co{{$co->id}}-t2" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>			
				@endforeach
				
			</tr>

			<tr>
			   <th>Internal</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="i" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>	
				@foreach ($cos as $co)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co{{$co->id}}-i" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>			
				@endforeach
				
			</tr>

			<tr>
			   <th>Assignment 1</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="a1" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>	
				@foreach ($cos as $co)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co{{$co->id}}-a1" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>			
				@endforeach
				
			</tr>
			<tr>
			   <th>Assignment 2</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="a2" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>	
				@foreach ($cos as $co)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co{{$co->id}}-a2" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>			
				@endforeach
				
			</tr>
			<tr>
			   <th>Attendance</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="attendance" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>	
				@foreach ($cos as $co)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co{{$co->id}}-attendance" size="5" pattern="[1-3.\-]" required>
					  </div>
					</td>			
				@endforeach				
			</tr>



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
 $(document).ready(function() {
	$('#co-po-matrix').validator().on('submit', function (e) {
	    if (e.isDefaultPrevented()) {
	         console.log("errors");
	    } else {
	  	  
	    }
	});
    

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