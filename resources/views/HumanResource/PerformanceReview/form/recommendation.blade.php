@if($pr_report->parent->supervisor_id == access()->id() && $pr_report->recommendation == null)
<div class="row mt-2">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">Final Recommendation to Human Resources:</h3>
		</div>
        <div class="card-body">
            {!! Form::open(['route' => ['hr.pr.recommendation.store',$pr_report]]) !!}
            <div class="row">
                <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <input type="checkbox" name="confirm_wef" required>
                        <label>Confirm w. e. f </label>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-5">
                    <div class="form-group">
                    <label>Extend probation for a period </label>
                        <input type="text" name="extend_probation">
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <input type="checkbox" name="terminate">
                        <label>Terminate </label>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                    <div class="form-group">
						<label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@else
@include('HumanResource.PerformanceReview.form.recommendation_update')
@endif
