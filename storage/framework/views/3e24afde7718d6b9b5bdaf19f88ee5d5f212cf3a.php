<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('HumanResource.HireRequisition.job._partials._shortlist_summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if($hire_requisition_job->shortlists()->count()): ?>
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
        <a href="" class="btn btn-primary pull-right">Submit to workflow</a>
    </div>
    <?php endif; ?>
    <?php echo $__env->make('HumanResource.HireRequisition.job._partials._job_description', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('HumanResource.HireRequisition.job._partials._online_applicants', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/HumanResource/HireRequisition/job/show.blade.php ENDPATH**/ ?>