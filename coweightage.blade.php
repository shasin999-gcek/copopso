@extends('layouts.master')
    @section('main_content')
		
		<!--Second form starts here ...form type the action to be done on form of CO-PO mapping Outcome-->

 		<form class="form-vertical" id="co-weightage" role="form" action="/storeco" method="GET">
		<table class="table">
		  <thead class="thead-inverse">
			<tr>
				<th></th>
				<th colspan="50"><t>Co Weigthage</t></th>
				
			</tr>
		   </thead>
		   <thead class="thead-inverse">
			<tr>
				<th></th>
				<th>Weightage</th>
				<th>CO 1</th>
				<th>CO 2</th>
				<th>CO 3</th>
				<th>CO 4</th>
				<th>CO 5</th>
				<th>CO 6</th>
				
				
				
			</tr>
			</thead>

			<!--creating form dynamically-->
			<tr>
			   <th>University Exam</th>
			   <td>
					<div class="form-group">
					    <input class="form-control" type="text" name="U-W" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>
				@for($i = 1; $i <= 6; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="U-co{{$i}}" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>Series Test1</th><td>
			   <div class="form-group">
					    <input class="form-control" type="text" name="T1-W" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>
				@for($i = 1; $i <= 6; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="T1-co{{$i}}" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>Series Test2</th>
			   <div class="form-group"><td>
					    <input class="form-control" type="text" name="T2-W" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>
				@for($i = 1; $i <= 6; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="T2-co{{$i}}" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>Internal</th><td>
			   <div class="form-group">
					    <input class="form-control" type="text" name="I-W" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>
				@for($i = 1; $i <= 6; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="I-co{{$i}}" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>Assignment1</th><td>
			   <div class="form-group">
					    <input class="form-control" type="text" name="A1-W" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>
				@for($i = 1; $i <= 6; $i++)
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="A1-co{{$i}}" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>			
				@endfor	
			</tr>
			<tr>
			   <th>Assignment2</th><td>
			   <div class="form-group">
					    <input class="form-control" type="text" name="A2-W" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>
			@for($i = 1; $i <= 6; $i++)
				<td>
				  <div class="form-group">
				    <input class="form-control" type="text" name="A2-co{{$i}}" size="5"  pattern="[1-100.\-]" required>
				  </div>
				</td>			
			@endfor	
			</tr>
			<tr>
			   <th>Attendane</th><td>
			   <div class="form-group">
					    <input class="form-control" type="text" name="A-W" size="5" pattern="[1-100.\-]" required>
					  </div>
					</td>
			@for($i = 1; $i <= 6; $i++)
				<td>
				  <div class="form-group">
				    <input class="form-control" type="text" name="A-co{{$i}}" size="5"  pattern="[1-100.\-]" required>
				  </div>
				</td>			
			@endfor	
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

     <!-- confirm Modal -->
  <div class="modal fade" id="confirmModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirm Changes</h4>
        </div>
        <div class="modal-body">
          <p>Do you want to save changes that u made.?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="btn-success-confirm">Save Changes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


@endsection				

@section('add-script')
<script type="text/javascript">
 $(document).ready(function() {
	$('#co-po-matrix').validator().on('submit', function (e) {
	    if (e.isDefaultPrevented()) {
	         console.log("errors");
	    } else {
	  	     e.preventDefault();
	         $('#confirmModal').modal();
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