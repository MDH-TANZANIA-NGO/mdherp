<?php $__env->startSection('content'); ?>
<div class="page ">
    <div class="page-content">
        <div class="container text-center">
            <div class="display-1 text-primary mb-5">400</div>
            <h1 class="h2  mb-3">Page Not Found</h1>
            <p class="h4 font-weight-normal mb-7 leading-normal ">Oops!!!! you tried to access a page which is not available. go back to Home</p>
            <a class="btn btn-primary" href="<?php echo e(route('workspace.invoke')); ?>">
                Back To Home
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/errors/400.blade.php ENDPATH**/ ?>