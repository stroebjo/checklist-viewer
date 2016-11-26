<?php $__env->startSection('title'); ?>
	Overview
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<h2 class="mt-1 mb-1">Available checklists</h2>

	<?php $__currentLoopData = $checklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $checklist): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>


	<div class="card">
		<div class="card-header">
			<a href="<?php echo e(url($checklist->id)); ?>">
				<?php echo e($checklist->name); ?>

			</a>
		</div>
	</div>


	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>