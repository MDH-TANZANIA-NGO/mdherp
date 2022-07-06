
<?php echo $__env->make('includes.workflow.workflow_track_tool', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if($wf_done == 1 && $wf_track->user_id == access()->id()): ?>
    <a href='#' class='btn btn-warning' onclick="event.preventDefault();if(confirm('Are you sure you want to recall this application to your level')){document.getElementById('workflow_resume_form').submit()}">
        <?php echo e(__('label.recall')); ?>

    </a>
    <form id="workflow_resume_form" action="<?php echo e(route('workflow.resume_from_wf_done',$wf_track)); ?>" method="POST" class="d-none">
        <?php echo csrf_field(); ?>
    </form>
<?php endif; ?>


<?php if($wf_done == 0): ?>
    
    <?php echo $__env->make('includes/workflow/pending_wf_tracks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <?php if($wf_track->checkIfHasRightCurrentWfTrackAction()): ?>
        <a href='#exampleModalCenter' class='btn btn-secondary' data-toggle='modal' id='approve_modal'>
            <?php echo e(__('label.action')); ?>

        </a>
    <?php endif; ?>

    
    <?php if($wf_track->checkIfHasRightToRecallToPreviousWfTrack()): ?>
        <a href='#' class='btn btn-warning' onclick="event.preventDefault();if(confirm('Are you sure you want to recall this application')){document.getElementById('workflow_recall_form').submit()}" >
            <?php echo e(__('label.recall')); ?>

        </a>

        <form id="workflow_recall_form" action="<?php echo e(route('workflow.recall',$previous_wf_track)); ?>" method="POST" class="d-none">
            <?php echo csrf_field(); ?>
        </form>
    <?php endif; ?>


    
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content">
                <?php echo $__env->make('system/workflow/modal/Approval_model', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

<?php endif; ?>
<?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/includes/workflow/workflow_contents.blade.php ENDPATH**/ ?>