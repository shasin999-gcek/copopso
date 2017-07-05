<?php $__env->startSection('main_content'); ?>
	<?php
		$status = $coursedata->status;
		$po_id = $status-1;
	?>

      <div class="page-header" style="margin-top: 10px;">
      <h1 class="text-primary">Status</h1>
      </div>

      <h3 class="text-primary">Course Outcomes</h3>

      <?php if($status == 0): ?>

      	<a href="/co/create/<?php echo e($coursedata->id); ?>" class="btn btn-success btn-panel">Define CO</a>

      <?php endif; ?>
      <?php if($status >= 1): ?>

	      <table class='table'>
	      <thead class="thead-inverse">
	      <tr>
	      		<th colspan="3"> CO </th>
	      		<th colspan="12"> Definition </th>
	      		
	      	</tr>
	      </thead>
	      	 <?php $__currentLoopData = $cos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $co): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		       <tr>
		       	<td><?php echo e($co->name); ?></td>
		           <td><?php echo e($co->description); ?></td>
		       </tr>
	   		 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
	   	  </table>  

      <?php endif; ?>

    
      <?php if($status == 1): ?>
	    <h3 class="text-primary">Relate CO-PO-PSO</h3>

      	<a href="/co/popso/create/<?php echo e($coursedata->id); ?>" class="btn btn-success btn-panel">Define Matrix</a>

      <?php endif; ?>
	  <?php if($status == 2): ?>
		  <h3 class="text-primary">Relate CO-PO-PSO</h3>
		  <div>
		  	<p>Matrix to be displayed here </p>
		  	<!-- To do: Code for displaying matrix -->
		  </div>

		  <h3 class="text-primary">Justify POs</h3>
		  <a href="/co/po/<?php echo e($coursedata->id); ?>/1" class="btn btn-success btn-panel">Justify POs</a>

      <?php endif; ?>

      <!--Check: bug with && conditon, for some reason  -->
      <?php if($status>2 && $status<18): ?>
		  <h3 class="text-primary">Justify POs</h3>
		  
		  <a href="/co/po/<?php echo e($coursedata->id); ?>/<?php echo e($po_id); ?>" class="btn btn-success btn-panel">Justify POs</a>

      <?php endif; ?>

      <?php if($status == 18): ?>

      <h3 class="text-primary">Distribute Weightage for CO</h3>
      	
      <a href="/co/<?php echo e($coursedata->id); ?>/weightage" class="btn btn-success btn-panel">Complete</a>

      <?php endif; ?>


      <?php if($status == 19): ?>
      <h3 class="text-primary">Upload Marksheet</h3>
      	
      <a href="/upload" class="btn btn-success btn-panel">Upload</a>

      <?php endif; ?>
		
<?php $__env->stopSection(); ?>
	
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>