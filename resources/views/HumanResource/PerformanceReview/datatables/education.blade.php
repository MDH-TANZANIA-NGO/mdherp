<div class="row">
	<div class="col-xl-12 col-lg-12 col-md-12" id="overall_holder">
		<div class="card">
        	<div class="card-header"><h3 class="card-title">Educational opportunities are needed for the employee?</h3>
        </div>
        	<div class="card-body">
                <p>{{ $pr_report->education->comment }}</p>
			</div>
		</div>
	</div>
	@if($pr_report->education && $pr_report->user_id == access()->id() && $pr_report->completed == 0)
	<div class="col-xl-12 col-lg-12 col-md-12 mb-2">
		<a href="{{ route('hr.pr.completed', $pr_report) }}" class="btn btn-primary col-xl-12 col-lg-12 col-md-12">Click Here to Complete Form</a>
	</div>
	@endif
</div>