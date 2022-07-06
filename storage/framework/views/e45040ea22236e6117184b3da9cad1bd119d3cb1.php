<!-- start: page -->
<div class="row">

    <div class="col">
        <div class="accordion" id="accordion">
            <div class="card card-default" style="background-color: #fff">
                <div class="card-header" style="background-color: rgb(152, 186, 217)">
                    <h4 class="card-title m-0">
                        <a class="accordion-toggle" style="color: #000" data-toggle="collapse"
                           data-parent="#accordion" href="#collapse1Two"><i class="fa fa-bars"></i>
                             <?php echo $wf_track->wfDefinition->wfModule->name; ?></a> <?php echo e(__('label.workflow.index')); ?>

                    </h4>
                </div>
                <div id="collapse1Two" class="collapse">
                    <div class="card-body">
                        <?php $__currentLoopData = $completed_tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col-sm-2">Level</div>
                            <div class="col-sm-9"><?php echo e($track->wfDefinition->level); ?></div>
                            <div class="col-sm-2">Designation</div>
                            <div class="col-sm-9">
                                <?php echo e($track->users->designation ? $track->users->designation->unit->name : ''); ?> <?php echo e($track->users->designation ? $track->users->designation->name : ''); ?>

                            </div>
                            <div class="col-sm-2">Name</div>
                            <div class="col-sm-9"><?php echo e($track->users->full_name); ?></div>
                            <div class="col-sm-12">Comment</div>
                            <div class="col-sm-12"><p class="alert" style="border: 1px solid #000; background-color:
                            rgb(238, 241, 248);
                            color: #000; display:
                            inline-block;
                            margin-top:5px; margin-bottom:
                            5px"><?php echo e($track->comments); ?></p></div>
                            <div class="col-sm-12">Received Date : <?php echo e($track->receive_date_formatted); ?></div>
                            <div class="col-sm-12"><?php echo e($track->status_narration); ?> Forwarded Date : <?php echo e($track->forward_date_formatted); ?></div>
                            <div class="col-sm-2">Status</div>
                            <div class="col-sm-9"><?php echo $track->status_narration_badge; ?></div>
                        </div>
                        <hr class="dotted">
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\mdherp\resources\views/includes/workflow/workflow_track_tool.blade.php ENDPATH**/ ?>