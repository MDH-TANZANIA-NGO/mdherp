<?php if(count($schedules)): ?>
    
      
    <div class="card">
        <div class="card-header">
           APPLICANT LIST INVITED FOR INTERVIEW
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
<?php endif; ?><?php /**PATH /Users/frank/Documents/Projects/mdherp2/resources/views/HumanResource/interview/applicant/selected_for_invitation.blade.php ENDPATH**/ ?>