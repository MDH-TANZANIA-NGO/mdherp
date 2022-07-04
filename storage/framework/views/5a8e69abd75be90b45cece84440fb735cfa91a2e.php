
<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('interview.notifyapplicant')); ?> " method="post">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('HumanResource.interview.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('HumanResource.interview.panelist.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('HumanResource.interview.applicant.selected_for_invitation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
    </form>
    <form action="<?php echo e(route('interview.addapplicant')); ?> " method="post">
        <?php if(count($interviewApplicants)): ?>
            <?php echo $__env->make('HumanResource.interview.includes.shortlisted', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
        <?php endif; ?>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/interview_date.blade.php ENDPATH**/ ?>