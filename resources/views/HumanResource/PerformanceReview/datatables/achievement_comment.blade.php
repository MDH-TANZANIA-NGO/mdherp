<div class="row">
	<div class="col-xl-12 col-lg-12 col-md-12" id="overall_holder">
		<div class="card">
        	<div class="card-header"><h3 class="card-title">Level of achievement on the expected plan of 3 months</h3>
        </div>
        	<div class="card-body">
                <p>{{ $pr_report->achievementComment->comment }}</p>
				<p>Comment By: {{ $pr_report->achievementComment->user->fullname }}</p>
				<p>Submited Date: {{ $pr_report->achievementComment->created_at }}</p>
			</div>
		</div>
	</div>
</div>