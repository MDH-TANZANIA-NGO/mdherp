
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE: <?php echo e($job_title->name); ?> </span>
            
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO : </span>
        </div>
    </div>
</div>

 
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">INTERVIEW REPORT</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-lg-2">
                        <label class="form-label">Panelist </label>
                    </div>
                    
                </div>
                <input type="submit" value="next" class="btn btn-primary">
              
            </div>
        </div>
    </div>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/report/create.blade.php ENDPATH**/ ?>