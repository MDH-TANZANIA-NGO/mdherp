 <?php
    $sql = "select
                users.id,
                concat_ws(' ', units.name, designations.name) as title,
                concat_ws(
                    ' ',
                    users.first_name,
                    users.middle_name,
                    users.last_name
                ) as full_name,
                users.email
            from
                hr_interview_panelists
                inner join users on users.id = hr_interview_panelists.id
                inner join designations on designations.id = users.designation_id
                inner join units on units.id = designations.unit_id
        where hr_interview_panelists.interview_id IN ('".implode("','",$interviews->pluck('id')->toArray()). "')";

   $panelists =  \DB::select($sql);   
    ?>
    <?php echo e(is_array($interviews->pluck('id'))); ?>

 <div class="row">
     <div class="card">
         <div class="card-header">
             <h3 class="card-title">PANELISTS</h3>
         </div>
         <div class="card-body">
             <table class="table table-bordered table-stripped">
                 <thead>
                     <th> # </th>
                     <th> Name </th>
                     <th> Title </th>
                     <th> Email </th>
                 </thead>
                 <tbody>
                    <?php $__currentLoopData = $panelists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$panelist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                         <td><?php echo e($key + 1); ?></td>
                         <td><?php echo e($panelist->full_name); ?></td>
                         <td><?php echo e($panelist->title); ?></td>
                         <td><?php echo e($panelist->email); ?></td>
                     </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/report/panelist_list.blade.php ENDPATH**/ ?>