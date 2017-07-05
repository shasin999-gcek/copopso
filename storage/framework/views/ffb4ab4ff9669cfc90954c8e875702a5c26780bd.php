<?php $__env->startSection('main_content'); ?>

   <div class="page-header" style="margin-top: 60px;">
     <h1 class="text-primary">Courses</h1>
   </div>
   <table class='table'>
   <thead class="thead-inverse">
   <tr>
   		<th> Year </th>
   		<th> Course </th>
   		<th> Branch </th>
   		<th> Semester </th>
   		<th> Status </th>
   		<th> Action </th>
   	</tr>
   </thead>

   	<?php $__currentLoopData = $coursedata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
    	<td><?php echo e($course->pivot->academic_year); ?></td>
        <td><?php echo e($course['course_code']); ?></td>
        <td><?php echo e($course->pivot->branch); ?></td>
        <td><?php echo e($course->pivot->semester); ?></td>
        <td>Incomplete</td>
        <td>
            <a href="/co/<?php echo e($course->pivot->id); ?>">View</a> 
        </td>
    </tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 </table>	    	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>