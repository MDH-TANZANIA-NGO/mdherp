
<?php $__env->startSection('content'); ?>
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('HumanResource.interview.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('HumanResource.interview.panelist.show', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('HumanResource.interview.applicant.selected_for_invitation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>  
        <?php if(count($interviewApplicants)): ?>
            <?php echo $__env->make('HumanResource.interview.applicant.shortlisted', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
        <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/show.blade.php ENDPATH**/ ?>