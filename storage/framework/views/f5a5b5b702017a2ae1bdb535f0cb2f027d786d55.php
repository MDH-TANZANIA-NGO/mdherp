
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="<?php echo e(route('advertisement.index')); ?>">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Advertisement</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="<?php echo e(route('hr.job.application')); ?>">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Job Applications</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="<?php echo e(route('interview.index')); ?>">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Interview</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="<?php echo e(route('job_offer.index')); ?>">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Job offers</div>
                </div>
            </div>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/humanResource/JobManagement/index.blade.php ENDPATH**/ ?>