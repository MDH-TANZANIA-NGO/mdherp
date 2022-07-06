 <?php
    $sql = "select
                hr_hire_applicants.id,
                concat_ws(
                    ' ',
                    hr_hire_applicants.first_name,
                    hr_hire_applicants.middle_name,
                    hr_hire_applicants.last_name
                ) as full_name,
                hr_interview_applicant_marks.marks
                from
                hr_hire_applicants
                join hr_interview_applicant_marks on hr_hire_applicants.id = hr_interview_applicant_marks.applicant_id  
                where hr_interview_applicant_marks.interview_id = ".$interview->id."
                order by
                hr_interview_applicant_marks.marks desc";
   $interview_reports =  \DB::select($sql);   
    ?>
 <div class="row">
     <div class="card">
         <div class="card-header">
             <h3 class="card-title">INTERVIEW TYPE : <?php echo e($interview->interviewType->name); ?> </h3>
         </div>
         <div class="card-body">
            <table class="table table-bordered table-striped">
                 <thead>
                     <th> # </th>
                     <!-- <th> Number </th> -->
                     <th> Applicant </th>
                     <th> Marks </th>
                     <th> Rank </th>
                 </thead>
                 <tbody>
                    <?php $__currentLoopData = $interview_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$interview_report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                         <td><?php echo e($key + 1); ?></td>
                         <td><?php echo e($interview_report->full_name); ?></td>
                         <td><?php echo e(number_format($interview_report->marks,2)); ?></td>
                         <td><?php echo e($key + 1); ?></td>
                         <!-- <td></td> -->
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/report/interveiw_list.blade.php ENDPATH**/ ?>