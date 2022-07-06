
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
            <?php echo $__env->renderEach('HumanResource.Interview.report.interveiw_list', $interviews, 'interview'); ?>
            <?php echo $__env->make('HumanResource.Interview.report.panelist_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('HumanResource.Interview.report.recommendation_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo Form::open(['route' => 'interview.report.store']); ?>

            <div class="form-group">
                <label class="form-lable">Recommendation Comment</label>
                <textarea class="summernotecontent" name="comment"></textarea>
            </div>
            <div class="form-group">
                <?php $__currentLoopData = $interviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input type="hidden" name="interviews[]" value="<?php echo e($interview->id); ?>"> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <input type="submit" value="Save" class="btn btn-success">
                <input type="submit" value="Submit for Approval" class="btn btn-primary">
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('after-scripts'); ?>
<script>
    $('.summernotecontent').summernote({
        height: 140,
        spellCheck: true,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen']]
        ]
    });

    
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/report/create.blade.php ENDPATH**/ ?>