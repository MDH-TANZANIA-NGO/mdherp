
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('humanResource.interview.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<form action="<?php echo e(route('interview.addpanelist')); ?> " method="post">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Panelists</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label class="form-label">Panelist </label>
                    </div>
                    <div class="col-lg-8">
                        <?php echo Form::select('panelist_id[]',$users,null,['class' => 'form-control select2','multiple'=>'true','data-placeholder'=>'Select panelists','required']); ?>

                    </div>
                </div>
                <input type="submit" value="next" class="btn btn-primary">
                <input type="hidden" name="hr_requisition_job_id" value="<?php echo e($interview->hr_requisition_job_id); ?>">
                <input type="hidden" name="interview_id" value="<?php echo e($interview->id); ?>">
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/humanResource/Interview/panelist/create.blade.php ENDPATH**/ ?>
