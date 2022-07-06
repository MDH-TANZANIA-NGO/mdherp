 <div class="tab-pane active">
     <div class="card-body">
         <div class="table-responsive">
             <table id="schedule_interview" class="table table-striped table-bordered" style="width:100%">
                 <thead>
                     <tr>
                         <th class="wd-15p">#</th>
                         <th class="wd-15p">NAME</th>

                     </tr>
                 </thead>
                 <tbody>
                    <?php
                        $scheduled_applicants = \DB::table('hr_interview_applicants')
                                                ->join('hr_hire_applicants','hr_hire_applicants.id','hr_interview_applicants.applicant_id')
                                                ->where('interview_schedule_id',$schedule)->get()
                    ?>
                    <?php $__currentLoopData = $scheduled_applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$scheduled_applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(($key+1)); ?></td>
                            <td><?php echo e($scheduled_applicant->first_name." ".$scheduled_applicant->last_name); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>


 <?php $__env->startPush('after-scripts'); ?>
 <script>
     $(document).ready(function() {

         $("#schedule_interview").DataTable({
             destroy: true,
             retrieve: true,
             "responsive": true,
             "autoWidth": false,
         });
          
     });
 </script>
 <?php $__env->stopPush(); ?><?php /**PATH /Users/frank/Documents/Projects/mdherp2/resources/views/HumanResource/interview/datatables/scheduled.blade.php ENDPATH**/ ?>