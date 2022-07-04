<?php $__env->startSection('content'); ?>
<div class="row">
    <?php echo $__env->make('HumanResource.HireRequisition.job._partials._shortlist_summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('HumanResource.HireRequisition.job._partials._job_description', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">APPLICANT DETAILS</h3>
                <div class="card-options ">
                    <?php if(is_shortlisted($applicant->id, $hire_requisition_job->id)): ?>
                    <a href="<?php echo e(route('hr.job.application.shortlist',[$hire_requisition_job->id, $applicant->id])); ?>" class="btn btn-primary" onclick='if(confirm("Are you sure you want to shortlist <?php echo e($personal_info->first_name); ?> <?php echo e($personal_info->middle_name); ?> <?php echo e($personal_info->last_name); ?>")){ return true; } else { return false; }'>Click here to Shortlist this Applicant</a>
                    <?php else: ?>
                    <a href="<?php echo e(route('hr.job.application.un_shortlist',[$hire_requisition_job->id, $applicant->id])); ?>" class="btn btn-danger" onclick='if(confirm("Are you sure you want to remove applicant shortlist <?php echo e($personal_info->first_name); ?> <?php echo e($personal_info->middle_name); ?> <?php echo e($personal_info->last_name); ?>")){ return true; } else { return false; }'>Click here to Remove this Applicant From Shortlist</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>CV and COVER LETTER</strong></td>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <td><a style="text-decoration: underline; color:blue" href="<?php echo e($attachment->cv); ?>">Curculum Vitae</a></td>
                                        <td><a style="text-decoration: underline; color:blue" href="<?php echo e($attachment->cover_letters); ?>">Cover Letter</a></td>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td> <strong>PERSONAL INFORMATION </strong></td>
                            <td>
                                <span style="margin-right: 10px"><b>NAME:</b> <?php echo e($personal_info->first_name." ".$personal_info->middle_name." ".$personal_info->last_name); ?></span>
                                <span style="margin-right: 10px"><b>GENDER:</b> <?php echo e($personal_info->gender); ?></span>
                                <span style="margin-right: 10px"><b>DOB:</b> <?php echo e($personal_info->dob); ?></span>
                                <span style="margin-right: 10px"><b>EMAIL:</b> <?php echo e($personal_info->email); ?></span>
                                <span style="margin-right: 10px"><b>MOBILE NUMBER:</b> <?php echo e($personal_info->phone); ?></span>
                                <span style="margin-right: 10px"><b>NATIONAL ID NO:</b> <?php echo e($personal_info->national); ?></span>
                                <span style="margin-right: 10px"><b>COUNTRY:</b> <?php echo e($personal_info->country); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ACADEMIC HISTORY: </strong></td>
                            <td>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>INSTITUTE/SCHOOL/UNIVERSITY</th>
                                            <th>AWARD RECEIVED</th>
                                            <th>START YEAR</th>
                                            <th>END YEAR</th>
                                            <th>STUDYING STATUS</th>
                                            <th>CERTIFICATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($education->institution_name); ?></td>
                                            <td style="width: 10%;"><?php echo e($education->award_received); ?></td>
                                            <td style="width: 10%;"><?php echo e($education->start_year); ?></td>
                                            <td><?php echo e($education->end_year); ?></td>
                                            <td><?php echo e($education->still_studying ? 'Completed' : 'still studying'); ?></td>
                                            <td><a href="<?php echo e($education->certificate); ?>">View</a></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ADDRESS: </strong></td>
                            <td>
                                <table style="width:100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>TYPE</th>
                                            <th>AREA NAME</th>
                                            <th>HOUSE NUMBER</th>
                                            <th>DISTRICT</th>
                                            <th>REGION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($address->address_type); ?></td>
                                            <td><?php echo e($address->area_name); ?></td>
                                            <td><?php echo e($address->house_number); ?></td>
                                            <td><?php echo e($address->district); ?></td>
                                            <td><?php echo e($address->region); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>EXPERIENCES: </strong></td>
                            <td>
                                <table style="width:100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>ORGANISATION NAME</th>
                                            <th>POSITION</th>
                                            <th>RESPONSIBILITIES</th>
                                            <th>REASON FOR LEAVING</th>
                                            <th>SUPERVISOR INFO</th>
                                            <th>START YEAR</th>
                                            <th>END YEAR</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $experience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($experience->organisation_name); ?></td>
                                            <td><?php echo e($experience->position); ?></td>
                                            <td><?php echo e($experience->responsibilities); ?></td>
                                            <td><?php echo e($experience->reason_for_leaving); ?></td>
                                            <td>NAME : <?php echo e($experience->supervisor_name); ?>, EMAIL: <?php echo e($experience->supervisor_email); ?>, MOBILE: <?php echo e($experience->supervisor_phone); ?></td>
                                            <td><?php echo e($experience->start_year); ?></td>
                                            <td><?php echo e($experience->end_year); ?></td>
                                            <td><?php echo e($experience->is_current ? 'Still working' : ''); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>SKILLS: </strong></td>
                            <td>
                                <table style="width:100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>CATEGORY</th>
                                            <th>SKILL</th>
                                            <th>LEVEL</th>
                                            <th>REMARKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($skill->category); ?></td>
                                            <td><?php echo e($skill->skill); ?></td>
                                            <td><?php echo e($skill->level); ?></td>
                                            <td><?php echo e($skill->remarks); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>REFEREES: </strong></td>
                            <td>
                                <table style="width:100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>NAME</th>
                                            <th>GENDER</th>
                                            <th>ORGANISATION</th>
                                            <th>POSITION</th>
                                            <th>EMAIL</th>
                                            <th>ADDRESS</th>
                                            <th>TYPE</th>
                                            <th>REGION</th>
                                            <th>COUNTRY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($referee->name); ?></td>
                                            <td><?php echo e($referee->gender); ?></td>
                                            <td><?php echo e($referee->organisation_name); ?></td>
                                            <td><?php echo e($referee->position); ?></td>
                                            <td><?php echo e($referee->email); ?></td>
                                            <td><?php echo e($referee->address); ?></td>
                                            <td><?php echo e($referee->reference_type); ?></td>
                                            <td><?php echo e($referee->region); ?></td>
                                            <td><?php echo e($referee->country); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
<script>
    $(document).ready(function() {
        $("#applicants").DataTable();
    })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/HumanResource/HireRequisition/job/applicant_details.blade.php ENDPATH**/ ?>