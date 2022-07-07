<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE:  <?php echo e($job_title->name); ?> </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE:  <?php echo e($interview_type->name); ?> </span>
		    <!-- <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO :  </span> -->
            <?php if(!isset($show)): ?>
                <?php echo $__env->make('HumanResource.Interview.form.send_notification_button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
		</div>
    </div>
</div><?php /**PATH /Users/william/Code/mdherp/resources/views/HumanResource/interview/header.blade.php ENDPATH**/ ?>