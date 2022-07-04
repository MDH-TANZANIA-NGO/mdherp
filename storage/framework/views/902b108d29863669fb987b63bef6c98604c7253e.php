<div class="custom_filter" style="display:none">
    <?php echo Form::open(['role' => 'form', 'id' => 'search-form']); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="module"><?php echo app('translator')->get('labels.backend.system.workflow.module'); ?>&nbsp;:</label>
                    <?php echo Form::select('wf_module_id', $wf_modules, request()->input('wf_module_id'), ['class' => 'form-control wf-module-select', 'placeholder' => '', 'data-group' => '', 'id' =>
                    'module']); ?>

                </div>


                <div class="form-group col-md-5">
                    <label for="application_category_id"><?php echo app('translator')->get('labels.category'); ?>&nbsp;:</label>
                    
                    
                    
                      
                     
                    <?php echo Form::text('application_category_id', request()->input('application_category_id'), ['class' => 'form-control ', 'autocomplete' => 'off', 'id' => 'application_category', 'required']); ?>


                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-success btn-sm btn-submit" value="<?php echo app('translator')->get('buttons.general.search'); ?>" />
                </div>
            </div>
        </div>
    </div>

    <?php echo Form::close(); ?>

</div><?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/system/workflow/pending_filter.blade.php ENDPATH**/ ?>