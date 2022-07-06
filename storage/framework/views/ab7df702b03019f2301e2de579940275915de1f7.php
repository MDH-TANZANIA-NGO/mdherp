
<?php $__env->startSection('content'); ?>
   
<div class="row">
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="<?php echo e(route('interview.list')); ?>">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Create Interview</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="<?php echo e(route('interview.report.index')); ?>">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Interview Report</div>
                </div>
            </div>
</a>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/humanResource/Interview/index.blade.php ENDPATH**/ ?>