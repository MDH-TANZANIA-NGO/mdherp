<!-- Section 1 -->
<li class="acc_section">
    <div class="acc_head d-flex justify-content-between">
        <h3> Job Title : <?php echo e($job->title); ?> | Employees Required: (<?php echo e($job->empoyees_required); ?>) </h3>
        <span> <a href="#"> View </a> | <a href="<?php echo e(route('hirerequisition.edit',$job->uuid)); ?> ">Edit</a> | <a href="#">Delete</a></span>
    </div>
    <div class="acc_content" style="display: none;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2" class="text-uppercase">
                        <h5 class="text-uppercase"> Job Title : <?php echo e($job->title); ?> </h5>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="gray">
                    <td colspan="2">
                        <h5 class="text-uppercase"> General Details </h5>
                    </td>
                </tr>
                <tr>
                    <td> <strong>Department: </strong></td>
                    <td> <?php echo e($job->department); ?> </td>
                </tr>
                <tr>
                    <td><strong>Number of Employees Required: </strong></td>
                    <td><?php echo e($job->empoyees_required); ?></td>
                </tr>
                <tr>
                    <td><strong>Location: </strong></td>
                    <td> <?php echo e($job->regions); ?>


                    </td>
                </tr>
                <tr>
                    <td><strong>Date Required : </strong></td>
                    <td><?php echo e($job->date_required); ?></td>
                </tr>
                <tr class="gray">
                    <td colspan="2">
                        <h5 class="text-uppercase">Person Required </h5>
                    </td>
                </tr>
                <tr>
                    <td><strong>Education and Qualification: </strong></td>
                    <td> <?php echo $job->education_and_qualification; ?></td>
                </tr>
                <tr>

                    <td><strong>Practical Experience: </strong></td>
                    <td> <?php echo $job->practical_experience; ?></td>
                </tr>
                <tr>
                    <td><strong>Other Special Qualities / Skills: </strong></td>
                    <td> <?php echo $job->special_qualities_skills; ?> </td>
                </tr>
                <tr class="gray">
                    <td colspan="2" class="text-uppercase">
                        <h5> Employement Condition </h5>
                    </td>
                </tr>
                <tr>
                    <td><strong>Prospect for appointment : </strong></td>
                    <td> <?php echo $job->contract_type; ?> </td>
                </tr>
                <tr>
                    <td><strong>Special Employment Condition : </strong></td>
                    <td> <?php echo $job->special_employment_condition; ?> </td>
                </tr>
                </tr>
                <tr>
                    <td><strong> Establishment : </strong></td>
                    <td> <?php echo e($job->establishment); ?> </td>
                </tr>
                <tr>
                    <td><strong> Working Tools : </strong></td>
                    <td>
                        <?php echo e($job->working_tools); ?>

                    </td>
                </tr>
                <tr class="gray">
                    <td colspan="2" class="text-uppercase">
                        <h5> Criteria </h5>
                    </td>
                </tr>
                <tr>
                    <td> Education Level </td>
                    <td> <?php echo e($job->_education_level->name); ?></td>
                </tr>
                <tr>
                    <td> Years Of Experience </td>
                    <td> <?php echo e($job->experience_years); ?></td>
                </tr>
                <tr>
                    <td> Age Between</td>
                    <td> <?php echo e($job->start_age); ?> And <?php echo e($job->start_age); ?></td>
                </tr>
                <tr>
                    <td> skills</td>
                    <td>
                        <ul class="ml-3" style="list-style-type: circle;">
                            <?php $__currentLoopData = $job->skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li> <?php echo e($skill->name); ?> </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</li><?php /**PATH /Users/william/Code/mdherp/resources/views/humanResource/hireRequisition/_parent/display/hr_job.blade.php ENDPATH**/ ?>