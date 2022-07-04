
<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('interview.notifyapplicant')); ?> " method="post">
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('HumanResource.interview.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('HumanResource.interview.panelist.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('HumanResource.interview.applicant.selected_for_invitation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</form>
<form action="<?php echo e(route('interview.addapplicant')); ?> " method="post">
    <div class="row mb-3">
        <label class="form-label col-sm-2 ">Interview Date </label>
        <div class="col-sm-3 ">
            <input type="datetime-local" class="form-control" name="interview_date" required>
        </div>
        <div class="col-lg-2">
            <label class="form-label">Location </label>
        </div>
        <div class="col-lg-3">
            <?php echo Form::select('district_id',$districts,null,['class' => 'form-control select2','data-placeholder'=>'Select district','required']); ?>

        </div>
       

    </div>
    <div class="row">
        <label class="form-label  col-sm-2">Location Description </label>
        <div class="col-lg-12">
            <textarea class="form-control" name="description" required></textarea>
        </div>
    </div>


    <input type="hidden" name="interview_id" value="<?php echo e($interview->id); ?>">
    <div class="row mb-3">
        <div class="col-sm-2 ">
            <input type="submit" class="btn btn-primary btn-inline-block" name="submit" value="Add Applicant To Interview">
        </div>
    </div>
    <?php if(count($interviewApplicants)): ?>
    <?php echo $__env->make('HumanResource.interview.applicant.shortlisted', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/initiate.blade.php ENDPATH**/ ?>