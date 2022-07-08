<?php $__env->startSection('content'); ?>
    <?php echo Form::open(['route' => 'induction_schedule.participants', 'method' => 'post',]); ?>

    <!-- Large Modal -->
    <div class="col-lg-12 col-md-12">
        <div class="card">


            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold"> Add Participant(s)</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Select Participant(s)</label>
                        <input class="hidden" name="induction_schedule_id" value="<?php echo e($inductionSchedule->id); ?>">
                        <?php echo Form::select('participants[]', $participants, null, ['class' =>'form-control select2 custom-select', 'multiple','required']); ?>

                    </div>
                    <?php $__errorArgs = ['participants'];
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

                &nbsp;

                <div class="row">

                    <div class="col-12">
                        <div style="text-align: center;">

                            <button type="submit" class="btn btn-azure"  >Add Participants </button>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/induction/_parent/forms/add.blade.php ENDPATH**/ ?>