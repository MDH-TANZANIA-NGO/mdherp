<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Edit Induction Schedule for <?php echo e($inductionScheduleItem->inductionSchedule->designation->getFullTitleAttribute()); ?> </p>
            </div>
            <div class="card-body">
                <?php echo Form::open(['route' => ['induction_schedule.update', $inductionScheduleItem], 'method' => 'put']); ?>

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="date" value="<?php echo e($inductionScheduleItem->date); ?>" type="datetime-local">
                            </div>
                            <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong> </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label class="form-label">Department</label>
                            <?php echo Form::select('department_id',$departments, $inductionScheduleItem->department_id,['class' => 'form-control select2', 'placeholder'=>'Select','required']); ?>

                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
                        <div class="form-group">
                            <label class="form-label">Area</label>
                            <div class="input-group">
                                <textarea class="form-control" name="area" rows="3" placeholder="" ><?php echo e($inductionScheduleItem->area); ?></textarea>
                                <input name="induction_schedule_id" value="<?php echo e($inductionScheduleItem->induction_schedule_id); ?>" class="hidden">
                                <?php $__errorArgs = ['area'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong> </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/induction/_parent/display/show.blade.php ENDPATH**/ ?>