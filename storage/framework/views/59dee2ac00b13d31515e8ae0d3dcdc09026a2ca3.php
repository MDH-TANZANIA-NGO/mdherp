<?php echo Form::open(['route' => 'project.store', 'method' => 'post',]); ?>

<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">


        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Register Project</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>
            
        </div>


        <div class="card-body">
            <div class="row">

                <div class="col-6" >
                    <label class="form-label">Project Code</label>
                    <input type="text" class="form-control" name="code" placeholder="ie. AK2" required>
                    <?php $__errorArgs = ['code'];
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

                <div class="col-6">
                    <label class="form-label">Project Title</label>
                    <input type="text" class="form-control" name="title" placeholder="ie. AFYA Kwanza" required>
                    <?php $__errorArgs = ['title'];
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

            &nbsp;

            <div class="row">

                <div class="col-6">
                    <label class="form-label">Project Type</label>
                    <?php echo Form::select('type', $types, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                    <?php $__errorArgs = ['type'];
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

                <div class="col-6 hidden" id="region_holder">
                    <label class="form-label">Select Region(s)</label>
                    <?php echo Form::select('regions[]', $regions, null, ['class' =>'form-control select2 custom-select', 'multiple','disabled','required']); ?>

                </div>
                <?php $__errorArgs = ['regions'];
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
                <div class="col-6">
                    <label class="form-label">Start Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" name="start_year" type="date" min="1997-01-01" required>
                    </div>
                    <?php $__errorArgs = ['start_year'];
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

                <div class="col-6">
                    <label class="form-label">End Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" name="end_year"  type="date" min="1997-01-01" required>
                    </div>
                    <?php $__errorArgs = ['end_year'];
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

            &nbsp;

            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Description </label>
                    <textarea class="form-control" name="description" rows="2" placeholder="Enter project descriptions..." required></textarea>
                </div>
                <?php $__errorArgs = ['description'];
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

                <button type="submit" class="btn btn-azure"  >Create Project </button>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<?php echo Form::close(); ?>


<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {
            let $type_input = $("select[name='type']");
            let $region_holder = $("#region_holder");
            let $region_input = $("select[name='regions[]']");

            $region_holder.hide();

            $type_input.change(function (event){
                event.preventDefault();
                let $value = $(this).val();
                if($value === "<?php echo e(config('mdh.project.with_region')); ?>"){
                    $region_holder.show()
                    $region_input.attr('disabled',false);
                }else{
                    $region_holder.hide();
                    $region_input.attr('disabled',true);
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>




<?php /**PATH /Users/william/Code/mdherp/resources/views/project/form/create.blade.php ENDPATH**/ ?>