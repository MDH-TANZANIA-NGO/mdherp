<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE: <?php echo e($job_title->name); ?> </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE: <?php echo e($interview_type->name); ?> </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO : </span>
        </div>
    </div>
</div>

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/HumanResource/Interview/panelist.blade.php ENDPATH**/ ?>