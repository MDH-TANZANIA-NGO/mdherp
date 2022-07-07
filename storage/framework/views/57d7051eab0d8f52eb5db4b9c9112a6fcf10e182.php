<?php $__env->startSection('content'); ?>

    <?php echo Form::open(['route' => ['leave.store']]); ?>

    <?php echo csrf_field(); ?>

 <?php if(access()->user()->assignedSupervisor() == null): ?>

     <div class="row">
         <div class="col-12 col-sm-12">
             <div class="card ">
                 <div class="card-header">
                     <p style="margin-left: 40%; font-size: large"> You have not been assigned supervisor</p>

                 </div>
                 <div>

                 </div>
             </div>
         </div>
     </div>



 <?php else: ?>
    <!-- Large Modal -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <div class="row text-center">
                        <span class="col-12 text-center font-weight-bold">Leave Request</span>
                    </div>

                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" >
                            <label class="form-label">Leave Type</label>
                            <?php echo Form::select('leave_type_id', $leaveTypes, null,['class' => 'form-control select2-show-search', 'required']); ?>

                            
                            <?php $__errorArgs = ['leave_type_id'];
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

                        <div class="col-md-6" >
                            <?php echo Form::label('employee_id', __("Select Co-worker in your absence"),['class'=>'form-label','required_asterik']); ?>

                            <?php echo Form::select('employee_id', $users, null,['class' => 'form-control select2-show-search', 'required']); ?>

                            <?php echo $errors->first('employee_id', '<span class="badge badge-danger">:message</span>'); ?>

                           
                        </div>

                    </div>
                    &nbsp;
                    &nbsp
                    <div class="row">
                        <div class="col-md-12" >
                            <label class="form-label">Comment</label>
                            <textarea class="form-control" name="comment" rows="2" placeholder="Comment..." ></textarea>
                            <?php $__errorArgs = ['comment'];
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
                    <div class="row mt-5">
                        <div class="col-md-6" >
                            <label class="form-label">Start Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="start_date" placeholder="MM/DD/YYYY" type="date">
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
                        <div class="col-md-6" >
                            <label class="form-label">End Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="end_date" placeholder="MM/DD/YYYY" type="date">
                            </div>
                            <?php $__errorArgs = ['end_date'];
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

                    &nbsp
                    &nbsp;
                    <div class="row">

                        <div class="col-12">
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-azure"> Request Leave</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="col-sm-12 col-md-6" style="margin-left: 25%">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Leave Balances</h3>
                        <div class="card-options ">
                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php $__currentLoopData = $leave_balances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_balances): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item justify-content-between">
                                <?php echo e($leave_balances->leaveType->name); ?>

                                <?php if($leave_balances->remaining_days <= 3 && $leave_balances->remaining_days > 0): ?>
                                <span class="badgetext badge badge-warning badge-pill"><?php echo e($leave_balances->remaining_days); ?></span>
                                <?php elseif($leave_balances->remaining_days >3 ): ?>
                                    <span class="badgetext badge badge-success badge-pill"><?php echo e($leave_balances->remaining_days); ?></span>
                                <?php elseif($leave_balances->remaining_days == 0): ?>
                                    <span class="badgetext badge badge-danger badge-pill"><?php echo e($leave_balances->remaining_days); ?></span>
                                    <?php endif; ?>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
        </div>
    <?php echo Form::close(); ?>


<?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/leave/_parent/form/create.blade.php ENDPATH**/ ?>