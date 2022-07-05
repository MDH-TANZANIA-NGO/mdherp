

<?php $__env->startSection('content'); ?>

    <div class="row">
        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'business_requisitions')): ?>
       <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('requisition.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="mdi mdi-cash multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Business Requisition</div>
                    </div>
                </div>
            </a>

        </div>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'safari_advance')): ?>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('safari.index')); ?>">
                <a href="<?php echo e(route('safari.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-subway multiple-outline text-primary" ></i></div>
                        <div class="text-muted mb-0">Safari Advance</div>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>

        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'program_activities')): ?>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('programactivity.workspace')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fe fe-activity multiple-outline text-primary" ></i></div>
                        <div class="text-muted mb-0">Program Activities</div>
                    </div>
                </div>
            </a>

        </div>
        <?php endif; ?>
        
        <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'retirement')): ?>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('retirement.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="zmdi zmdi-receipt multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Retirements</div>
                    </div>
                </div>
            </a>

        </div>
        <?php endif; ?>

    </div>
<div class="row">




    <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'hr_services')): ?>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('account.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-handshake-o multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">Human Resource</div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'cqi_dashboard')): ?>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e('http://41.188.137.37:8080/dfqi/index.php?token='.access()->user()->loginToken->token); ?>" target="_blank">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-bar-chart-o multiple-outline text-primary"></i></div>
                        <div class="text-muted mb-0">DQI Tool</div>
                    </div>
                </div>
            </a>
        </div>

    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'hire_requisition')): ?>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('hirerequisition.list')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-child text-primary"></i></div>
                        <div class="text-muted mb-0">Hire Requisition</div>
                    </div>
                </div>
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/workspace/index.blade.php ENDPATH**/ ?>