<div class="row">
    <div class="col-12">
        <?php echo Form::open(['route' => ['user.update_definitions', $user], 'method' => 'post']); ?>

        <?php $__currentLoopData = $wf_module_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <fieldset class="scheduler-border">
                <!-- <legend class="scheduler-border">Module: <?php echo e($group->name); ?></legend> -->

                <div class="control-group">

                    <?php $__currentLoopData = $group->modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="row" style="background-color: rgb(238, 241, 248)">
                            <div class="col-sm-3" style="margin-top: 15px;">
                        <h6><?php echo e($module->name); ?></h6>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <?php $__currentLoopData = $module->definitions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $definition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-sm-4 col-lg-4 col-xl-4 col-md-4">
                                    <!-- checkbox -->
                                    <div class="form-group clearfix">
                                        <div class="icheck-secondary d-inline">
                                            <input type="checkbox" id="definition_<?php echo e($definition->id); ?>" value="<?php echo e($definition->id); ?>" name="definitions[]" <?php echo e($user->hasWfDefinition($definition->id) ? 'checked' : ''); ?>>
                                            <label for="definition_<?php echo e($definition->id); ?>" title="<?php echo e($definition->description); ?>"><?php echo e($key + 1); ?> . <?php echo e($definition->description); ?></label> <br>
                                            <span style="display: block; font-size: 12px !important; color: grey; margin-top: -5px"><?php echo e($definition->designation->unit->name." ".$definition->designation->name); ?></span>
                                        </div>
                                    </div>
                                    <!-- checkbox -->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php if($module->count() > 1): ?>
                            <hr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

            </fieldset>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <hr>
        <div class="col-12 mt-5">
            <input type="submit" class="btn btn-flat btn-secondary" value="<?php echo e(__('label.update')); ?>">
        </div>
        <?php echo Form::close(); ?>

    </div>
</div>
<?php /**PATH /Users/william/Code/mdherp/resources/views/system/workflow/definition_assignment.blade.php ENDPATH**/ ?>