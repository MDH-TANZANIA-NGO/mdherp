<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('interview.notifyapplicant')); ?> " method="post">
<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE:  <?php echo e($job_title->name); ?> </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE:  <?php echo e($interview_type->name); ?> </span>
		    <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO :  </span>
            <?php if(count($schedules)): ?>
            <span class="tag tag-rounded pull-right">   <input type="submit" value="Send Notification" class="btn btn-primary"></span>
            <?php endif; ?>
		</div>
    </div>
</div>
    <?php echo $__env->make('HumanResource.interview.includes.panelists', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(count($schedules)): ?>
    
        <?php echo csrf_field(); ?>
        <div class="card">
            <div class="card-header">
               
            </div>
            <div class="card-body">
                
                <input type="hidden" name="interview_id" value="<?php echo e($interview->id); ?>">
                <ul class="demo-accordion accordionjs m-0" data-active-index="false">
                
                    <?php $__currentLoopData = $schedules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $_schedule =  \DB::table('hr_interview_schedules')->where('id',$schedule)->first();
                            $total_scheduled_applicants = \DB::table('hr_interview_applicants')->where('interview_schedule_id',$schedule)->count();
                        ?>
                        <li class="acc_section">
                            <div class="acc_head d-flex justify-content-between">
                                <h3> Interview Date : <?php echo e($_schedule->interview_date); ?> | Total Candidate : (<?php echo e($total_scheduled_applicants); ?>) </h3>
                            </div>
                            <div class="acc_content" style="display: none;">
                                <?php echo $__env->make('HumanResource.interview.datatables.scheduled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>         
    <?php endif; ?>
</form>
<form action="<?php echo e(route('interview.addapplicant')); ?> " method="post">
<?php if(count($interviewApplicants)): ?>
    <?php echo $__env->make('HumanResource.interview.includes.shortlisted', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
<?php endif; ?>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/HumanResource/Interview/interview_date.blade.php ENDPATH**/ ?>