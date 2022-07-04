<?php $__env->startSection('content'); ?>

    

    <div class="row">

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('person.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-address-book-o text-primary"></i></div>
                        <div class="text-muted mb-0">Personal Details</div>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('education.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-mortar-board text-primary"></i></div>
                        <div class="text-muted mb-0">Education</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('experience.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-black-tie text-primary"></i></div>
                        <div class="text-muted mb-0">Experience</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('timesheet.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-clock-o text-primary"></i></div>
                        <div class="text-muted mb-0">Timesheet</div>
                    </div>
                </div>
            </a>

        </div>

        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('leave.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-briefcase text-primary"></i></div>
                        <div class="text-muted mb-0">Leave</div>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('userbio.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-slideshare text-primary"></i></div>
                        <div class="text-muted mb-0">Know your Co-Workers</div>
                    </div>
                </div>
            </a>

        </div>
      


        <div class="col-4 col-sm-4 col-lg-3">
            <a href="<?php echo e(route('hr.pr.index')); ?>">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="h2 m-0"><i class="fa fa-file text-primary"></i></div>
                        <div class="text-muted mb-0"><?php echo e(__('label.performance_review')); ?></div>
                    </div>
                </div>
            </a>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/account/index.blade.php ENDPATH**/ ?>