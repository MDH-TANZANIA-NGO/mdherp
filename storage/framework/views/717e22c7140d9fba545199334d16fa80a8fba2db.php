<?php $__env->startSection('content'); ?>
<?php if(isset($initiate)): ?>
<?php echo $__env->make('HumanResource.HireRequisition._parent.datatables.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<div class="panel panel-primary">
	<div class=" tab-menu-heading card-header sw-theme-dots">
		Approved Job Requisition
	</div>
	<div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
		<?php if(isset($initiate)): ?>
		<form action="<?php echo e(route('hirerequisition.addRequisition',$uuid)); ?>" method="post">
		<?php else: ?>
		<form action="<?php echo e(route('hirerequisition.store')); ?>" method="post">
			<?php endif; ?>
			<?php echo csrf_field(); ?>
			<!-- Large Modal -->
			<div class="col-lg-12 col-md-12">
				<table id="table access_processing" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th class="wd-15p">#</th>
							<th class="wd-15p">TITLE</th>
							<th class="wd-15p">REGION</th>
							<th class="wd-25p"># OF EMPLOYEES</th>
							<th class="wd-25p">CREATED AT</th>
							<th class="wd-25p">CREATED BY</th>
							<th class="wd-25p">APPROVED ON</th>
							<th class="wd-25p">ACTION</th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $hireRequisitionJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$hireRequisitionJob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr class="wd-15p">
							<td><?php echo e($key+1); ?></td>
							<td><?php echo e($hireRequisitionJob->title); ?></td>
							<td><?php echo e($hireRequisitionJob->region); ?></td>
							<td><?php echo e($hireRequisitionJob->empoyees_required); ?></td>
							<td><?php echo e($hireRequisitionJob->created_at); ?></td>
							<td><?php echo e($hireRequisitionJob->created_at); ?></td>
							<td><?php echo e($hireRequisitionJob->created_at); ?></td>
							<td><a href="<?php echo e(route('advertisement.initiate',$hireRequisitionJob->uuid)); ?>"> Create Advertisement </a></td>
						<tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>
		</form>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('after-scripts'); ?>
<style>
	.breadcrumb1 {
		background-color: rgb(152, 186, 217);
		border-radius: 0;
	}
	.breadcrumb1 li {
		margin: 0;
	}
	.gray {
		background-color: #f2f5fb;
	}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/HumanResource/HireRequisition/advertisement/form/create.blade.php ENDPATH**/ ?>