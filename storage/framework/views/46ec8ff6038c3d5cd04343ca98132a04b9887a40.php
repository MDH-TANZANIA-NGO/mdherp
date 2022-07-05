<?php $__env->startSection('content'); ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'user_management')): ?>
   <?php echo $__env->make('user.profile.view_profile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('permission', 'hr_dashboard')): ?>
    <?php echo $__env->make('user.profile.employee_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/user/profile/index.blade.php ENDPATH**/ ?>