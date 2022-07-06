<?php $__env->startPush('after-styles'); ?>
    <style>
        #form_status{
            display: none;
        }
    </style>
<?php $__env->stopPush(); ?>

<!-- Modal -->

<div class="modal-header" style="background-color: #7ab9e1">
    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff"><b><?php echo e(__('label.workflow.index')); ?></b></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

    <?php echo Form::open(['route' => ['workflow.update_workflow', $wf_track->id],'id'=>'approval_form']); ?>

    <div class="modal-body">

        <div class="card-body">

            <?php echo Form::hidden('assigned', $wf_track->assigned); ?>

            <?php echo Form::hidden('action', "approve_reject"); ?>

            
            <div class="form-group">
                <label class="required_asterik" for="status"><?php echo e(__('label.action')); ?></label>
                <?php echo Form::select('status', $statuses, null, ['class' => 'search-select workflow_status_select', 'style' => 'width:100%;border-radius:3px;height:32px;','required']); ?>

                <span class="help-block"></span>
            </div>

            <div class="field-layout reject_to_level mb-2">
                <div class="form-group">
                    <label class="required_asterik" for="level"><?php echo e(__('label.designation')); ?></label>
                    <?php echo Form::select('level', $previous_levels, null, ['class' => 'reject_to_level_select','style'=>'width:100%;border-radius:3px;height:32px;','required']); ?>

                </div>
            </div>

            <?php if($has_to_assign and isset($next_users)): ?>
            <div class="form-group assign_to_level mb-2">
            <label class="required" for="user"><?php echo app('translator')->get('label.select_officer'); ?></label>
            <?php echo Form::select('user', $next_users, [], ['class' => 'search-select assign_to_level_select', 'style' => 'width:100%;border-radius:3px;height:32px;','required' , 'placeholder' => 'Select']); ?>

            <span class="help-block"></span>
            </div>
            <?php endif; ?>

            <div class="form-group mb-2">
                <label class="required_asterik" for="comments"><?php echo e(__('label.comment')); ?></label>
                <?php echo Form::textarea('comments', null, ['class' => 'form-control textarea autosize', 'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal;border-radius: 3px;','required']); ?>

            </div>



        </div>


    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit_approval_modal"><?php echo e(__('label.submit')); ?></button>
        <span id="form_status"></span>
        <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(__('label.cancel')); ?></button>
    </div>
    <?php echo Form::close(); ?>




<?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/system/workflow/modal/Approval_model.blade.php ENDPATH**/ ?>