<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE:  <?php echo e($job_title->name); ?> </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE:  <?php echo e($interview_type->name); ?> </span>
		    <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO :  </span>
            <?php if(isset($schedules) && count($schedules)): ?>
                <?php if(!Session::has('msg')): ?> 
                    <span class="tag tag-rounded pull-right">   <input type="submit" value="Send Notification" class="btn btn-primary"></span>
                <?php endif; ?>
            <?php endif; ?>
		</div>
    </div>
</div><?php /**PATH /Users/frank/Documents/Projects/mdherp2/resources/views/HumanResource/interview/header.blade.php ENDPATH**/ ?>