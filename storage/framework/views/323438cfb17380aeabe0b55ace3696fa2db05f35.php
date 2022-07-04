<div class="col-xl-12 col-md-12 col-md-12 col-lg-12 mt-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Applicants</h3>
        </div>
        <div class="card-body">
            <table id="applicants" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-15p">#</th>
                        <th class="wd-15p">FIRST NAME</th>
                        <th class="wd-15p">MIDDLE NAME</th>
                        <th class="wd-15p">LAST NAME</th>
                        <th class="wd-15p">EMAIL</th>
                        <th class="wd-15p">MOBILE NUMBER</th>
                        <th class="wd-15p">STATUS</th>
                        <th class="wd-25p">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($key + 1); ?></td>
                        <td><?php echo e($applicant->first_name); ?></td>
                        <td><?php echo e($applicant->middle_name); ?></td>
                        <td><?php echo e($applicant->last_name); ?></td>
                        <td><?php echo e($applicant->email); ?></td>
                        <td><?php echo e($applicant->phone); ?></td>
                        <td>
                            <?php echo e(is_shortlisted($applicant->id, $hire_requisition_job->id) ? 'Not Shortlisted' : 'Shortlisted'); ?>

                        </td>
                        <td><a href="<?php echo e(route('hr.job.show_more',[$hire_requisition_job,$applicant->id])); ?>">View More info</td>
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
        $("#applicants").DataTable();
    })
</script>
<?php $__env->stopPush(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/HumanResource/HireRequisition/job/_partials/_online_applicants.blade.php ENDPATH**/ ?>