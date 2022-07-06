
<?php $__env->startPush('nav-head'); ?>
    <?php echo $__env->make('includes.navigation.workflow.new_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

                <?php echo $__env->make("system/workflow/count_summary", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- start: page -->
            <div class="row">

                <div class="col">
                    <section class="card">
                        <div class="card-body">
                            <?php echo $__env->make("system/workflow/pending_filter", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make("system/workflow/pending_table", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </section>
                </div>

            </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
    <!-- Custom javascript files for this page -->
    <?php echo $__env->make("system/workflow/pending_script", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', ['title' => 'icap Attendance System', 'header' => 'Home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/system/workflow/new.blade.php ENDPATH**/ ?>