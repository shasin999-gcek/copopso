<?php $__env->startSection('main_content'); ?>

<div class="row">
 <div class="col-lg-8 col-lg-offset-1">
  <div class="panel panel-primary">
   <div class="panel-heading">Define Cource Outcomes</div>
     <div class="panel-body">

       <form method="POST" action="/co/<?php echo e($coursedata->id); ?>" data-toggle="validator" class="form-horizontal" role="form">
    	<?php echo e(csrf_field()); ?>

    	<?php for($i=1; $i<=6; $i++): ?>
		<div class="form-group has-feedback">
			<label for="inputName" class="col-lg-1 control-label"><h4><?php echo e($coursecode); ?>.<?php echo e($i); ?></h4></label>
			<div class="col-lg-9 col-lg-offset-2">
				<textarea type="text" class="form-control" id="inputName" name="co<?php echo e($i); ?>"
				 cols="80" rows="4" pattern="^[_A-z0-9]{1,}$"  value="<?php echo e(old('co1')); ?>" required></textarea >
				 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			     <p class="help-block with-errors"></p>
			</div>
		</div>
		<?php endfor; ?>


	<div class="form-group">
			 <button type="submit" class="btn btn-success btn-panel">Submit</button>
		</div>
	 </form>
    </div><!--end panel body-->
   </div><!--end panel-->
  </div><!--end col-->
 </div><!--end row-->

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




<?php $__env->stopSection(); ?>

<?php $__env->startSection('add-script'); ?>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>