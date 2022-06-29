<div class="row mt-2">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">Final Recommendation to Human Resources:</h3>
		</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <input type="checkbox" name="confirm_wef" {{ $pr_report->recommendation->confirm_wef ? 'checked' : '' }} disabled>
                        <label>Confirm w. e. f </label>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-5">
                    <div class="form-group">
                    <label>Extend probation for a period </label>
                        <input type="text" name="extend_probation" value="{{ $pr_report->recommendation->extend_probation }}" disabled>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                    <div class="form-group">
                        <input type="checkbox" name="terminate" {{ $pr_report->recommendation->terminate ? 'checked' : '' }} disabled>
                        <label>Terminate </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
