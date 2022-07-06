<div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
    <div class="card">
        <div class="p-3">
            <h3 class="card-title mb-3">Shortlist Summary</h3>
            <div class="row widget-text">
                <div class="col-4">
                    <h3 class="mb-0"><?php echo e(collect($applicants)->count()); ?></h3>
                    <span class=" mb-0 fs-12 text-muted">All Applicants</span>
                </div>
                <div class="col-4 ">
                    <h3 class="mb-0"><?php echo e($hire_requisition_job->shortlists()->count()); ?></h3>
                    <span class=" mb-0 fs-12 text-muted">Shortlisted Applicants</span>
                </div>
                <div class="col-4 ">
                    <h3 class="mb-0"><?php echo e(collect($applicants)->count() - $hire_requisition_job->shortlists()->count()); ?></h3>
                    <span class=" mb-0 fs-12 text-muted">Unselect Applicants</span>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/william/Code/mdherp/resources/views/HumanResource/HireRequisition/job/_partials/_shortlist_summary.blade.php ENDPATH**/ ?>