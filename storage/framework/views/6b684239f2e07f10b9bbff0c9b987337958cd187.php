

<?php $__env->startSection('content'); ?>


    <!-- Row -->
    <div class="row">
        <div class="col-xl-3 col-lg-5 col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-center border-bottom-0">
                                

                                <?php if($user->getMedia('profile_pic')->first() != null): ?>
                                    <img data-no-retina="" class="img-circle img-responsive img-bordered-primary brround" src="<?php echo e($user->getMedia('profile_pic')->first()->getUrl()); ?>"  height="100" width="100" >
                                <?php else: ?>
                                    <img data-no-retina="" class="img-circle img-responsive img-bordered-primary" src="<?php echo e(URL::asset('mdh/images/users/login.png')); ?>" height="100" width="100" >
                                <?php endif; ?>

                            </li>
                            <li class="text-center">
                                <h4 class="text-capitalize mt-3 mb-0"><?php echo e($user->full_name_formatted); ?></h4>
                                <p class="text-muted text-capitalize">MDH Staff</p>
                            </li>
                            <li>
                                <a href="<?php echo e(route('user.password_reset',$user)); ?>" class="btn btn-outline-warning text-center btn-block"><i class="fe fe-unlock mr-2"></i>Reset Password</a>
                            </li>
                            <li><br></li>

                            <li>
                                <table class="table   table-striped  table-outline text-nowrap">

                                    <tbody>
                                    <tr><td>Active since:<?php echo e($user->created_at); ?> </td></tr>
                                    <tr><td>Last Update: <?php echo e($user->updated_at); ?></td></tr>
                                    <tr>
                                        <?php if($user->assignedSupervisor() == null): ?>
                                            <td>Assign Supervisor:
                                                <?php echo Form::open(['route' => ['user.assign_supervisor_individual'],'method' => 'POST']); ?>

                                                <?php echo Form::select('supervisor',$supervisors,null,['class' => 'form-control select2-show-search', 'style'=>'width: 100%']); ?>

                                                <input type="number" name="user_id" value="<?php echo e($user->id); ?>" hidden><br>
                                                <input type="submit" value="Assign" class="btn btn-outline-info text-center btn-block" style="margin-top: 3%">
                                                <?php echo Form::close(); ?>

                                            </td>
                                        <?php else: ?>
                                            <td><?php echo e($supervisor); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                    
                                    </tbody>



                                </table>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-9 col-lg-7 col-md-12">


            <div class="card">

                <div class="tab-menu-heading" style="background-color: rgb(238, 241, 248)">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#tab1" class="active" data-toggle="tab">Details</a></li>
                            <?php if($user->supervisor): ?><li><a href="#tab2" data-toggle="tab">Supervision</a></li><?php endif; ?>
                            <li><a href="#tab3" data-toggle="tab">Workflow</a></li>
                            <li><a href="#tab4" data-toggle="tab">Permissions</a></li>
                            
                            <li><a href="#tab6" data-toggle="tab">Leave Setup</a></li>
                            <li><a href="#tab7" data-toggle="tab">Level of Effort Setup</a></li>
                            
                            
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="tab1">

                            <?php echo Form::open(['route' => ['user.update', $user],'method' => 'PUT','class' => 'card']); ?>

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo Form::label('identity_no', __("Employee No"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::text('identity_number',$user->identity_number,['class' => 'form-control', 'placeholder' => 'ie. John','required']); ?>

                                            <?php echo $errors->first('identity_number', '<span class="badge badge-danger">:message</span>'); ?>

                                            <input type="date" value="null" name="employed_date" hidden>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::text('first_name',$user->first_name,['class' => 'form-control', 'placeholder' => '','required']); ?>

                                            <?php echo $errors->first('first_name', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <?php echo Form::label('middle_name', __("label.name.middle"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::text('middle_name',$user->middle_name,['class' => 'form-control', 'placeholder' => '','required']); ?>

                                            <?php echo $errors->first('middle_name', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <?php echo Form::label('last_name', __("label.name.last"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::text('last_name',$user->last_name,['class' => 'form-control', 'placeholder' => '','required']); ?>

                                            <?php echo $errors->first('last_name', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php echo Form::label('dob', __("label.dob"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::date('dob',$user->dob,['class' => 'form-control', 'placeholder' => '','required']); ?>

                                            <?php echo $errors->first('dob', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <?php echo Form::label('email', __("label.email"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::email('email',$user->email,['class' => 'form-control', 'placeholder' => '','required']); ?>

                                            <?php echo $errors->first('email', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <?php echo Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::text('phone',$user->phone,['class' => 'form-control', 'placeholder' => '','required']); ?>

                                            <?php echo $errors->first('phone', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <?php echo Form::label('gender', __("label.gender"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::select('gender', $gender, $user->gender_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                                            <?php echo $errors->first('gender', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <?php echo Form::label('marital', __("label.marital"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::select('marital', $marital, $user->marital_status_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                                            <?php echo $errors->first('marital', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <?php echo Form::label('designation', __("label.designation"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::select('designation', $designations, $user->designation_id, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                                            <?php echo $errors->first('designation', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <?php echo Form::label('region', __("label.region"),['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::select('region', $regions, $user->region_id, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                                            <?php echo $errors->first('region', '<span class="badge badge-danger">:message</span>'); ?>

                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <?php echo Form::label('projects', __("label.project").'(s)',['class'=>'form-label','required_asterik']); ?>

                                            <?php echo Form::select('projects[]', $projects, $user_projects, ['class' =>'form-control select2-show-search', 'aria-describedby' => '','multiple']); ?>

                                            <?php echo $errors->first('projects', '<span class="badge badge-danger">:message</span>'); ?>


                                        </div>
                                    </div>
                                    


                                    
                                    <div class=" col-md-4">
                                        <div class="form-group">
                                            <label class="custom-switch">
                                                <input type="checkbox" name="supervisor" <?php echo e($user->supervisor ? 'checked' : ''); ?> class="custom-switch-input" >
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Is Supervisor
                                                                    </span>
                                            </label>
                                        </div>
                                    </div>
                                    


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4" style="margin-left: 45%">
                                    <div class="form-group">
                                        <?php echo Form::submit('Update Profile',['class' => 'btn btn-outline-info']); ?>

                                    </div>
                                </div>

                            </div>
                            <?php echo Form::close(); ?>


                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="card-body">
                                
                                <?php echo Form::open(['route' => ['user.assign_supervisor', $user->id],'method' => 'post']); ?>

                                <div class="form-group">
                                    <label class="form-label">Select Employee</label>
                                    <div class="input-group">
                                        
                                        <?php echo Form::select('users[]',$users,null,['class' => 'form-control select2-show-search', 'multiple','style'=>'width: 100%']); ?>


                                    </div>
                                    &nbsp;
                                    <div class="input-group text-center" style="margin-left: 500px">


                                        <button class="btn btn-primary" type="submit">Select!</button>

                                    </div>

                                </div>


                                <?php echo Form::close(); ?>


                                <hr>
                                
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p">Fullname</th>
                                            <th class="wd-20p">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $user_with_supervisor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supervised): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($supervised->names); ?></td>
                                                <td><a href="<?php echo e(route('user.remove_supervisor', $supervised->user_id)); ?>" onclick="return confirm('are you sure?')"><button class="form-control btn-danger">Remove</button></a></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- table-wrapper -->
                            



                        </div>

                        <div class="tab-pane " id="tab3">
                            
                            <?php echo $__env->make('system.workflow.definition_assignment',['user' => $user, 'wf_module_groups'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane " id="tab4">
                            
                            <div class="card-body">
                                <?php echo Form::open(['route' => ['user.permission_update', $user]]); ?>


                                <div class="row" style="background-color: rgb(238, 241, 248)">
                                    <div class="col-sm-3" style="margin-top: 15px;">
                                        <h6>User Permissions</h6>
                                    </div>
                                </div>

                                &nbsp;

                                <div class="row">
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-sm-4">
                                            <!-- checkbox -->
                                            <div class="form-group clearfix">
                                                <div class="icheck-secondary d-inline">
                                                    <input name="permissions[]" type="checkbox" id="permission_<?php echo e($permission->id); ?>" value="<?php echo e($permission->id); ?>" name="definitions[]"
                                                        <?php echo e($user->checkPermission($permission->id) ? 'checked' : ''); ?>>
                                                    <label for="permission_<?php echo e($permission->id); ?>" title="<?php echo e($permission->description); ?>">
                                                        <?php echo e($key + 1); ?> . <?php echo e($permission->display_name); ?>

                                                    </label>
                                                </div>
                                            </div>
                                            <!-- checkbox -->
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <div class="row">
                                    <?php echo Form::submit('Attach Permission',['class'=>'btn btn-primary']); ?>

                                </div>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                        <div class="tab-pane " id="tab5">
                            
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p">Action</th>
                                            <th class="wd-15p">Date Perfomed</th>
                                            <th class="wd-20p">IP Address</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Create Requisition</td>
                                            <td>2018/03/12</td>
                                            <td>192.168.1.200</td>

                                        <tr>
                                            <td>Approve Requisition</td>
                                            <td>2018/03/12</td>
                                            <td>192.168.1.200</td>
                                        </tr>
                                        <tr>
                                            <td>Apply Safari Advance</td>
                                            <td>2018/03/12</td>
                                            <td>192.168.1.200</td>
                                        </tr>

                                        <tr>
                                            <td>Submit LPO</td>
                                            <td>2018/03/12</td>
                                            <td>192.168.1.200</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- table-wrapper -->
                        </div>

                        <div class="tab-pane " id="tab6">

                            <?php if($leave_balances->count() == 0): ?>

                                <?php echo Form::open(['route' => ['leave.setup'],'method' => 'POST']); ?>


                                <ul class="list-group">
                                    <?php if($user->gender_cv_id == 6): ?>
                                        <?php $__currentLoopData = $male_leave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $leave_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="number" value="<?php echo e($user->id); ?>" name="data[<?php echo e($key); ?>][user_id]" hidden >
                                            <li class="list-group-item justify-content-between">

                                                <?php echo e($leave_type->name); ?><input type="number" value="<?php echo e($leave_type->id); ?>" name="data[<?php echo e($key); ?>][leave_id]" hidden>
                                                <span class="badgetext badge  badge-pill"><input type="number" value="<?php echo e($leave_type->days); ?>" name="data[<?php echo e($key); ?>][remaining_days]" class="form-control"></span>
                                            </li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php elseif($user->gender_cv_id == 7): ?>
                                        <?php $__currentLoopData = $female_leave; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $leave_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input type="number" value="<?php echo e($user->id); ?>" name="data[<?php echo e($key); ?>][user_id]" hidden >
                                            <li class="list-group-item justify-content-between">

                                                <?php echo e($leave_type->name); ?><input type="number" value="<?php echo e($leave_type->id); ?>" name="data[<?php echo e($key); ?>][leave_id]" hidden>
                                                <span class="badgetext badge  badge-pill"><input type="number" value="<?php echo e($leave_type->days); ?>" name="data[<?php echo e($key); ?>][remaining_days]" class="form-control"></span>
                                            </li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endif; ?>



                                </ul>
                                <button class="btn btn-outline-primary" type="submit" style="margin-left: 40%; margin-top: 2%">Submit</button>
                                <?php echo Form::close(); ?>


                            <?php else: ?>
                                <?php echo Form::open(['route' => ['leave.update_setup', $user->id],'method' => 'PUT']); ?>


                                <ul class="list-group">

                                    <?php $__currentLoopData = $leave_balances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $leave_balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <input type="number" value="<?php echo e($user->id); ?>" name="data[<?php echo e($key); ?>][user_id]" hidden >
                                        <li class="list-group-item justify-content-between">
                                            <?php echo e($leave_balance->leaveType->name); ?><input type="number" value="<?php echo e($leave_balance->leave_type_id); ?>" name="data[<?php echo e($key); ?>][leave_id]" hidden>
                                            <span class="badgetext badge  badge-pill"><input type="number" value="<?php echo e($leave_balance->remaining_days); ?>" name="data[<?php echo e($key); ?>][remaining_days]" class="form-control"></span>
                                        </li>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                </ul>
                                <button class="btn btn-outline-primary" type="submit" style="margin-left: 40%; margin-top: 2%">Update</button>
                                <?php echo Form::close(); ?>

                                
                            <?php endif; ?>



                        </div>

                        <div class="tab-pane " id="tab7">
                                <?php echo Form::open(['route' => ['timesheet.effortUpdate'],'method' => 'POST']); ?>

                                <ul class="list-group">
                                    <?php $__currentLoopData = $user_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <input type="number" value="<?php echo e($user->id); ?>" name="data[<?php echo e($key); ?>][user_id]" hidden >
                                        <li class="list-group-item justify-content-between">
                                            <?php echo e($project->title); ?><input type="number" value="<?php echo e($project->id); ?>" name="data[<?php echo e($key); ?>][project_id]" hidden>
                                            <span class="badgetext badge  badge-pill"><input type="number" value="<?php echo e($project->percentage); ?>" name="data[<?php echo e($key); ?>][percentage]" class="form-control"></span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <button class="btn btn-outline-primary" type="submit" style="margin-left: 40%; margin-top: 2%">Update</button>
                                <?php echo Form::close(); ?>

                        </div>

                        <div class="tab-pane " id="tab8">
                            <div class="emp-tab">
                                <div class="table-responsive">
                                    <table class="table  table-hover table-striped">
                                        <thead class="text-primary">
                                        <tr>
                                            <th>Leave Type</th>
                                            <th>Remaining Days</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php echo Form::open(['route' => ['timesheet.setup'],'method' => 'POST']); ?>

                                        <?php if($leave_balances == NULL): ?>

                                            <tr>
                                                <td>This user has no leave balances</td>
                                            </tr>

                                        <?php else: ?>
                                            <?php $__currentLoopData = $leave_balances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($leave_balance->id); ?></td>
                                                    <td><?php echo e($leave_balance->leaveType->name); ?></td>
                                                    <td><?php echo e($leave_balance->remaining_days); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php echo Form::close(); ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane " id="tab9">
                            <div class="emp-tab">
                                <div class="table-responsive">
                                    <table class="table  table-hover table-striped">
                                        <thead class="text-primary">
                                        <tr>
                                            <th>Project</th>
                                            <th>Level of Effort %</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php echo Form::open(['route' => ['timesheet.effortUpdate'],'method' => 'POST']); ?>

                                        <?php if($effort_levels == NULL): ?>

                                            <tr>
                                                <td>This user has no leave balances</td>
                                            </tr>

                                        <?php else: ?>
                                            <?php $__currentLoopData = $effort_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $effort_level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <input type="number" value="<?php echo e($user->id); ?>" name="data[<?php echo e($key); ?>][user_id]" hidden >
                                                    <input type="number" value="<?php echo e($effort_level->project_id); ?>" name="data[<?php echo e($key); ?>][project_id]" hidden>
                                                    <td><?php echo e($effort_level->projects->title); ?></td>
                                                    <td><input type="number" name="data[<?php echo e($key); ?>][percentage]" value="<?php echo e($effort_level->percentage); ?>"></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <button class="btn btn-outline-primary" type="submit" style="margin-left: 40%; margin-top: 2%">Submit</button>
                                        <?php echo Form::close(); ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>





                    </div>
                </div>


            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>







<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/user/profile/view_profile.blade.php ENDPATH**/ ?>