<?php $__env->startSection('content'); ?>
<?php if($job_details != null): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form elements</h3>
                    <h3 class="card-title">Create job offer</h3>
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">

                        <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-user"></i>
												</span>
                            <input type="text" class="form-control" placeholder="Username">
                        </div>
                    </div>


            </div>
                    <ul class="demo-accordion accordionjs m-0" data-active-index="false">

                        <!-- Section 1 -->
                        <li class="acc_section">
                            <div class="acc_head"><h3><?php echo e($job_details->full_name); ?>: <b><?php echo e($job_details->unit_name); ?> <?php echo e($job_details->designation_name); ?></b></h3></div>
                            <div class="acc_content" style="display: none;"><p><?php echo e($job_details->description); ?></p></div>
                        </li>

                    </ul>
<br>
                    <?php echo Form::open(['route' => 'job_offer.store']); ?>

                <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Salary amount</label>
                        <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-dollar-sign"></i>
												</span>
                            <input type="text" class="form-control" name="salary" placeholder="Salary Amount">
                        </div>
                    </div>
                    </div>
                    <input type="number" name="hr_hire_requisitions_job_applicants_id" value="<?php echo e($job_details->id); ?>" hidden>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Date of arrival</label>
                            <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-calendar"></i>
												</span>
                                <input type="datetime-local" name="date_of_arrival" min="<?php echo e(now()->format('Y-m-d')); ?>" class="form-control" placeholder="Salary Amount">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Date of End of Tenure</label>
                            <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-calendar"></i>
												</span>
                                <input type="date" class="form-control" name="end_tenure">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="form-label">Project</label>
                            <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-dollar-sign"></i>
												</span>
                                <?php echo Form::select('projects[]', $projects, null, ['class' =>'form-control select2-show-search', 'aria-describedby' => '','multiple']); ?>


                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Other benefits</label>
                    <input type="text" name="details" class="content">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-instagram"><i class="fa fa-arrow-circle-left mr-2"></i>Back</a>
                    <button type="submit" class="btn btn-vk"><i class="fa fa-paper-plane-o mr-2"></i>Send for approval</button>


            </div>
                <?php echo Form::close(); ?>

        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/humanResource/jobOffer/forms/create.blade.php ENDPATH**/ ?>