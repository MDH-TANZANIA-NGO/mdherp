<div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
    <div class="card">
        <div class="p-3">
            <h3 class="card-title mb-3">Shortlist Summary</h3>
            <div class="row widget-text">
                <div class="col-4">
                    <h3 class="mb-0">{{ collect($applicants)->count() }}</h3>
                    <span class=" mb-0 fs-12 text-muted">All Applicants</span>
                </div>
                <div class="col-4 ">
                    <h3 class="mb-0">{{ $hire_requisition_job->shortlists()->count() }}</h3>
                    <span class=" mb-0 fs-12 text-muted">Shortlisted Applicants</span>
                </div>
                <div class="col-4 ">
                    <h3 class="mb-0">{{ collect($applicants)->count() - $hire_requisition_job->shortlists()->count() }}</h3>
                    <span class=" mb-0 fs-12 text-muted">Unselect Applicants</span>
                </div>
            </div>
        </div>
    </div>
</div>