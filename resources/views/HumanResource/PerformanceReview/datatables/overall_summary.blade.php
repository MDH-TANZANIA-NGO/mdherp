<div class="row">
	<div class="col-xl-12 col-lg-12 col-md-12" id="overall_holder">
		<div class="card">
        	<div class="card-header"><h3 class="card-title">C. OVERALL PERFORMANCE OF THE EMPLOYEE AND REWARD RECOMMENDATION</h3>
            <div class="card-options">
				<a href="{{ url()->current() }}" class="btn btn-default">Refresh</a>
             {{--   @if($pr_report->remarks()->count() == 0 && $pr_report->supervisor_id == access()->id())
				    @if($can_update_attribute_rate_resource)
                        <button data-toggle="modal" data-target="#remarksModel" class="btn btn-primary">Initiate Remarks</button>
                    @endif
                @endif
                --}}
			</div>
        </div>
        	<div class="card-body">
                <table class="table table-striped table-bordered" style="width: 100%">
                    <tbody>
                        <tr><td>Average Rate for set performance goals - Part A</td><td>{{ avg_per_pr_objective($pr_report->parent) }}</td></tr>
                        @if($pr_report->user->supervisor)
                            <tr><td>Average Rate for competencies & skills – Part B</td><td>{{ avg_per_pr_objective($pr_report->parent) }}</td></tr>
                            <tr><td>TOTAL RATING</td><td>{{ avg_per_pr_objective($pr_report->parent) + avg_per_pr_objective($pr_report->parent) }}</td></tr>
                            <tr><td>AVERAGE</td><td>{{ round((avg_per_pr_objective($pr_report->parent)+avg_per_key_competence_report($pr_report->parent))/2) }}</td></tr>
                        @else
                            <tr><td>Average Rate for competencies & skills – Part B</td><td>{{ avg_per_pr_attribute_rate($pr_report->parent) }}</td></tr>
                            <tr><td>TOTAL RATING</td><td>{{ avg_per_pr_objective($pr_report->parent) + avg_per_pr_attribute_rate($pr_report->parent) }}</td></tr>
                            <tr><td>AVERAGE</td><td>{{ round((avg_per_pr_objective($pr_report->parent)+avg_per_pr_attribute_rate($pr_report->parent))/2) }}</td></tr>
                        @endif
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>