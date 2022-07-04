
<div class="row mb-3">
    <label class="label col-sm-2 ">Interview Date </label>
    <div class="col-sm-8 ">
        <input  type="datetime-local" class="form-control" name="interview_date" required>
    </div>
    <div class="col-sm-2 ">
        <input type="submit" class="btn btn-primary btn-inline-block" name="submit" value="Add">
    </div>
</div>

<div class="row mt-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">ShortList</h3>
            <h3 class="card-title">ShortList Number </h3>
        </div>
        <div class="card-body">

            <?php echo csrf_field(); ?>
            <input type="hidden" value="<?php echo e($interview->id); ?>" name="interview_id">
            <div class="tab-pane active" id="processing">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="access_processing" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">NAME</th>
                                    <th class="wd-15p">SELECT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $interviewApplicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$interviewApplicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td> <?php echo e(($key + 1)); ?> </td>
                                    <td> <?php echo e($interviewApplicant->full_name); ?> </td>
                                    <td> <input type='checkbox' name='applicant[]' value='<?php echo e($interviewApplicant->id); ?> '> </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('after-scripts'); ?>
 <script>
     $(document).ready(function() {

         $("#access_processing").DataTable({
             destroy: true,
             "responsive": true,
             "autoWidth": false,

         });

     });
 </script>
 <?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/humanResource/interview/includes/shortlisted.blade.php ENDPATH**/ ?>
