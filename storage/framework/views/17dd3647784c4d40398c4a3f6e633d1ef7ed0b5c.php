    <?php $__env->startSection('main_content'); ?>
		
	

		<form class="form-vertical"role="form" action="/co/<?php echo e($id); ?>/weightage" method="POST">
		<?php echo e(csrf_field()); ?>

		<table class="table">
		  <thead class="thead-inverse">
			<tr>
				<th></th>
				<th >Weightage</th>

				<?php for($i=1; $i<=$co_count; $i++): ?>
					<th>CO<?php echo e($i); ?></th>
				<?php endfor; ?>
			</tr>
		   </thead>
		   
			<tr>
			   <th>University</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="u" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>	
				<?php $__currentLoopData = $cos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $co): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co<?php echo e($co->id); ?>-u" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>			
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</tr>
			
			<tr>
			   <th>Series 1</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="t1" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>	
				<?php $__currentLoopData = $cos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $co): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co<?php echo e($co->id); ?>-t1" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>			
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</tr>

			<tr>
			   <th>Series 2</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="t2" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>	
				<?php $__currentLoopData = $cos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $co): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co<?php echo e($co->id); ?>-t2" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>			
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</tr>

			<tr>
			   <th>Internal</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="i" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>	
				<?php $__currentLoopData = $cos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $co): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co<?php echo e($co->id); ?>-i" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>			
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</tr>

			<tr>
			   <th>Assignment 1</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="a1" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>	
				<?php $__currentLoopData = $cos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $co): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co<?php echo e($co->id); ?>-a1" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>			
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</tr>
			<tr>
			   <th>Assignment 2</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="a2" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>	
				<?php $__currentLoopData = $cos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $co): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co<?php echo e($co->id); ?>-a2" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>			
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
			</tr>
			<tr>
			   <th>Attendance</th>
			   		<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="attendance" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>	
				<?php $__currentLoopData = $cos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $co): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<td>
					  <div class="form-group">
					    <input class="form-control" type="text" name="co<?php echo e($co->id); ?>-attendance" size="5" pattern="[0-100.\-]" required>
					  </div>
					</td>			
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				
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


 


<?php $__env->stopSection(); ?>				

<?php $__env->startSection('add-script'); ?>
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
 			 $(this).val(0);
  		   });
  		   $('.text-danger').removeClass('text-danger').addClass('text-success');
  		} else {
  		   var fieldsWithHypen = $('input:text').filter(function() {
              return this.value == 0;
  		   });	
           fieldsWithHypen.each(function() {
 			  $(this).val('');
  		   });
  		   $('.text-success').removeClass('text-success').addClass('text-danger');
  		}    
  	});

}); 
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>