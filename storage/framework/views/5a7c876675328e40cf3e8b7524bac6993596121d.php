<?php $__env->startSection('main_content'); ?>

   <div class="page-header" style="margin-top: 60px;">
     <h1 class="text-primary">Justification</h1>
     <h4 class="text-primary">PO<?php echo e($podata->id); ?>:: <?php echo e($podata->name); ?></h4>
     <h6 class="text-primary"><?php echo e($podata->body); ?></h4>
   </div>
   		<?php $po_id=$podata->id; ?>  
   		<!-- Check: for some reason, specifying $podata->id in route for action is buggy -->
   		<form class="form-vertical" role="form" method='POST' action='/co/storejust/<?php echo e($id); ?>/<?php echo e($podata->id); ?>'>
		<?php echo e(csrf_field()); ?>


		<table class="table">
		  
		  <thead class="thead-inverse">
			<tr>
				<th class="col-lg-2">CO</th>
				<th class="col-lg-2">Weightage for PO</th>
				<th class="col-lg-8">Reason for weightage given</th>
			</tr>
		   </thead>
		   
		  <?php $__currentLoopData = $copo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $codata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<th class="col-lg-2"><?php echo e($codata["name"]); ?></th>
				<th class="col-lg-2"><?php echo e($codata["po_value"]); ?></th>
				<th class="col-lg-8">
					<input class="form-control" type="text" name='<?php echo e($codata["id"]); ?>' cols="60" rows="4" pattern="^[_A-z0-9]{1,}$" required>
					

				</th>
			</tr>
		  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
		
			
			<?php if(count($errors)): ?>
			<div class="form-group">
				<div class="alert alert-danger">
					<ul>
						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li> <?php echo e($error); ?> </li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			</div>
			<?php endif; ?>
		<button type="submit" class="btn btn-success" id="btn-submit">Submit</button>

	</form>
	

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
		$(function() {
			$('#form').validate();
		});
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>