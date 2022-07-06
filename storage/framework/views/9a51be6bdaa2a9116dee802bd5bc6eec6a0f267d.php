 <div class="row">
     <div class="card">
         <div class="card-header">
             <h3 class="card-title">RECOMMENDATION</h3>
             <?php if(!isset($show)): ?>
                <div class="card-options">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add To Recommendation</button>
                </div>
             <?php endif; ?>
         </div>
         <div class="card-body">
             <table class="table table-bordered table-striped">
                 <thead>
                     <th> # </th>
                     <th> Name </th>
                     <th> Email </th>
                     <?php if(!isset($show)): ?>
                     <th> Action </th>
                     <?php endif; ?>
                 </thead>
                 <tbody>
                    <?php $__currentLoopData = $recommended_applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$recommended_applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <?php echo e($key+1); ?> </td>
                            <td> <?php echo e($recommended_applicant->full_name); ?></td>
                            <td> <?php echo e($recommended_applicant->email); ?></td>
                            <?php if(!isset($show)): ?>
                             <td> <a href="">Remove</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Add Applicant To Recommendation List</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">
             <?php echo Form::open(['route' => 'interview.report.recommend']); ?>

                 <div class="form-group">
                     <label class="form-label">Applicant</label>
                     <?php echo Form::select('applicant_id',$applicants,null,['class' => 'form-control select2','width'=>'100','data-placeholder'=>'Select panelists','required']); ?>

                 </div>
                 <div class="form-group">
                     <label class="form-label">Comment </label>
                     <textarea class="form-control" name="comment" rows="7" placeholder="text here.."></textarea>
                 </div>
                 <input type="hidden" name="hr_requisition_job_id" value="<?php echo e($hireRequisitionJob); ?>">
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Save changes</button>
             </div>
             <?php echo Form::close(); ?>

         </div>
     </div>
 </div>
 <?php $__env->startPush('after-scripts'); ?>
 <script>

 </script>
 <?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/report/recommendation_list.blade.php ENDPATH**/ ?>