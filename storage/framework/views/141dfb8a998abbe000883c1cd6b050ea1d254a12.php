<?php $__env->startSection('content'); ?>

    <!-- Row-->

    <!-- End Row-->

    <?php if($un_sync_g_officers->count()>0 ): ?>
    <div class="row  mb-3">
        <span class="col-12 text-left font-weight-bold">Import Summary</span>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="p-3">
                    <div class="row widget-text">
                        <div class="col-4">
                            <h3 class="mb-0 text "><?php echo e($duplicate_entries->count()); ?></h3>
                            <p class=" mb-0 fs-13 text text-danger">Duplicate Entries</p>
                        </div>
                        <div class="col-4">
                            <h3 class="mb-0"><?php echo e($un_sync_g_officers->count()); ?></h3>
                            <span class=" mb-0 fs-13 text text-info">Total Imported Entries</span>
                        </div>
                        <div class="col-4">
                            <h3 class="mb-0"><?php echo e($uploaded_and_confirmed->count()); ?></h3>
                            <span class=" mb-0  fs-13 text text-success">Successfully Registered</span>
                        </div>
                     <div class="row" style="margin-top: 2%; margin-left:23%">
                         <div class="btn-list">
                             <a href="<?php echo e(route('g_officer.export_duplicate')); ?>" class="btn btn-pill btn-secondary"><i class="fe fe-download-cloud mr-2"></i>Download duplicate entries</a>
                             <a href="<?php echo e(route('g_officer.confirm')); ?>" onclick="if (confirm('Are you sure you want to confirm?')){return true} else {return false}"class="btn btn-pill btn-info"><i class="fe fe-check-circle mr-2"></i>Confirm imported entries</a>
                             <a href="<?php echo e(route('g_officer.clear')); ?>" onclick="if (confirm('Are you sure you want to remove duplicate?')){return true} else {return false}" class="btn btn-pill btn-warning"><i class="fe fe-trash-2 mr-2"></i>Remove duplicate entries</a>

                         </div>
                     </div>





                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row  mb-3">
        <span class="col-12 text-left font-weight-bold">Individual External Users Registration</span>
    </div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <?php echo Form::open(['route' => 'g_officer.store','class'=>'card']); ?>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']); ?>

                        <?php echo Form::text('first_name',old('first_name'),['class' => 'form-control', 'placeholder' => '','required']); ?>

                        <?php echo $errors->first('first_name', '<span class="badge badge-danger">:message</span>'); ?>

                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('middle_name', __("label.name.middle"),['class'=>'form-label','required_asterik']); ?>

                        <?php echo Form::text('middle_name',old('middle_name'),['class' => 'form-control', 'placeholder' => '']); ?>

                        <?php echo $errors->first('middle_name', '<span class="badge badge-danger">:message</span>'); ?>

                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('last_name', __("label.name.last"),['class'=>'form-label','required_asterik']); ?>

                        <?php echo Form::text('last_name',old('last_name'),['class' => 'form-control', 'placeholder' => '','required']); ?>

                        <?php echo $errors->first('last_name', '<span class="badge badge-danger">:message</span>'); ?>

                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group ">
                        <?php echo Form::label('gender', __("label.gender"),['class'=>'form-label','required_asterik']); ?>

                        <?php echo Form::select('gender', $gender, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                        <?php echo $errors->first('gender', '<span class="badge badge-danger">:message</span>'); ?>

                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <?php echo Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']); ?>

                        <?php echo Form::text('phone',null,['class' => 'form-control', 'placeholder' => '','required']); ?>

                        <?php echo $errors->first('phone', '<span class="badge badge-danger">:message</span>'); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <?php echo Form::label('g_scale', __("Title"),['class'=>'form-label','required_asterik']); ?>

                        <?php echo Form::select('g_scale', $g_scales, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                        <?php echo $errors->first('g_scale', '<span class="badge badge-danger">:message</span>'); ?>

                    </div>
                </div>
       
                <?php echo Form::text('check_no',null,['class' => 'form-control', 'placeholder' => '','hidden']); ?>

                <div class="col-md-4">
                    <div class="form-group ">
                        <?php echo Form::label('district', __("District"),['class'=>'form-label','required_asterik']); ?>

                        <?php echo Form::select('district_id', $districts, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                        <?php echo $errors->first('district_id', '<span class="badge badge-danger">:message</span>'); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <?php echo Form::label('Facilities', __("Facilities"),['class'=>'form-label','required_asterik']); ?>

                        <?php echo Form::select('facilities[]', $facilities, null, ['class' =>'form-control select2-show-search', 'aria-describedby' => '','multiple']); ?>

                        <?php echo $errors->first('facilities', '<span class="badge badge-danger">:message</span>'); ?>

                    </div>
                </div>


                <button type="submit" class="btn btn-info" style="margin-left:45%;"><i class="fa fa-paper-plane mr-2"></i>Submit</button>

            </div>
        </div>

        <?php echo Form::close(); ?>

        <div class="row  mb-3">
            <span class="col-12 text-left font-weight-bold">Bulk External Users Registration (Max 100 rows of data)</span>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
               
                <form action="<?php echo e(route('g_officer.import')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="file" name="file" class="dropify">
                    <div class="row" style="margin-left: 43%">
                        <br>


                    </div>
                    <button class="btn btn-info" style="margin-left: 43%"><i class="fe fe-upload mr-2"></i>Upload User Data</button>
                    
                </form>
            </div>

        </div>


</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/gofficer/gofficer/form/create.blade.php ENDPATH**/ ?>