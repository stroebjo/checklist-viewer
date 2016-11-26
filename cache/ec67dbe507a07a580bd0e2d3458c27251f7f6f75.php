<?php $__env->startSection('title'); ?>
	<?php echo e($checklist->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


	<h2 class="mt-1 mb-1"><?php echo e($checklist->name); ?></h2>

	<?php $__currentLoopData = $checklist->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>


	<div class="card">
		<div class="card-header">
		<?php if($item->description): ?>

			<div class="float-xs-right">
				<button class="btn btn-sm btn-link" type="button" data-toggle="collapse" data-target="#checklistItem<?php echo e($loop->index); ?>" aria-expanded="false" aria-controls="checklistItem<?php echo e($loop->index); ?>">
					Details
				</button>
			</div>
		<?php endif; ?>


				<label class="custom-control custom-checkbox mb-0">
					<input type="checkbox" class="custom-control-input">
					<span class="custom-control-indicator"></span>
					<span class="custom-control-description">
						<b><?php echo e($loop->iteration); ?>.</b>
						<?php echo $item->nameHTML; ?>


					</span>
				</label>
		</div>

		<?php if($item->description): ?>

		<div class="collapse" id="checklistItem<?php echo e($loop->index); ?>">
			<div class="p-1">
				<?php echo $item->descriptionHTML; ?>

			</div>
		</div>

		<?php endif; ?>
	</div>


	<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>