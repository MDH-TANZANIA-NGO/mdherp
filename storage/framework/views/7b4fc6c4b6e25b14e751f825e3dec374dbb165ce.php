
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <?php echo Form::open(['route' => 'designation.store','class'=>'card']); ?>

            <div class="card-body">
               <div class="example">
                   <div class="row" >
                       <div class="col-md-4">
                           <div class="form-group">
                               <?php echo Form::label('Unit', __("Unit"),['class'=>'form-label','required_asterik']); ?>

                               <?php echo Form::text('unit',null,['class' => 'form-control', 'placeholder' => 'HIV/TB Prevention','required']); ?>

                               <?php echo $errors->first('designation', '<span class="badge badge-danger">:message</span>'); ?>

                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="form-group">
                               <?php echo Form::label('designation', __("Designation"),['class'=>'form-label','required_asterik']); ?>

                               <?php echo Form::select('designation', ['Officer'=>'Officer','Manager'=>'Manager', 'Assistance'=>'Assistance','Advisor'=>'Advisor', 'Director'=>'Director'], null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>


                               <?php echo $errors->first('first_name', '<span class="badge badge-danger">:message</span>'); ?>

                           </div>
                       </div>
                       <div class="col-md-4">
                           <div class="form-group">
                               <?php echo Form::label('department', __("Department"),['class'=>'form-label','required_asterik']); ?>

                               <?php echo Form::select('department', $departments, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>


                               <?php echo $errors->first('first_name', '<span class="badge badge-danger">:message</span>'); ?>

                           </div>
                       </div>



                   </div>
                   <button type="submit" class="btn btn-info" style="margin-left:45%;"><i class="fa fa-plus-circle mr-2"></i>Add</button>

               </div>

            </div>
    </div>

    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/Designation/forms/create.blade.php ENDPATH**/ ?>