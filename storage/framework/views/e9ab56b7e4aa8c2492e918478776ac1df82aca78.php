
<div class="row">
    <div class="col-md-12">
        <?php $__currentLoopData = array_chunk($group_counts, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group_count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <?php $__currentLoopData = $group_count; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($value['count']): ?>
                        <div class="col-4 col-sm-4 col-lg-3">
                            <a id="<?php echo $value['id']; ?>"  href="<?php echo e(url("/") . "/" . request()->route()->uri()); ?>?wf_module_id=<?php echo e($value['id']); ?>"   <?php if(!empty
                        ($value['description'])): ?> data-toggle="popover" data-trigger="hover"
                               data-placement="bottom" data-content="<?php echo e($value['description']); ?>" <?php endif; ?>>
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="text-muted mb-0"> <?php echo e($value['name']); ?> [ <?php echo e($value['count']); ?> ] </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



    </div>
</div>

<br/>

<?php /**PATH /Users/william/Code/mdherp/resources/views/system/workflow/count_summary.blade.php ENDPATH**/ ?>