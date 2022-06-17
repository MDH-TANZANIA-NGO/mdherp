<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="font-size: 16px; color:#000">{{ $pr_report->parent->type->title }}</span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">Appraisal due on : {{ $pr_report->parent->from_at }}</span>
		    <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> Completed on : {{ $pr_report->parent->to_at }}</span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> Number : {{ $pr_report->parent->number }}</span>
            <span class="tag tag-rounded" style="background-color: green; font-size: 16px; color: #fff"> Approved on : {{ $pr_report->parent->wf_done_date }}</span>
		</div>
    </div>

    <div class="col-xl-12 col-lg-12 col-md-12">
		<div class="card">
			<div class="p-3">
				<h3 class="card-title mb-2">OVERALL PERFORMANCE OF THE EMPLOYEE AND REWARD RECOMMENDATION</h3>
					<div class="row">
						<div class="col-4 border-right">
							<p class=" mb-0 fs-12  text-muted">Average Rate for set performance goals - Part A</p>
							<h3 class="mb-0">{{ avg_per_pr_objective($pr_report->parent) }}</h3>
						</div>
						<div class="col-4 border-right ">
							<p class=" mb-0 fs-12 text-muted">Average Rate for competencies & skills – Part B</p>
							<h3 class="mb-0">{!! avg_per_key_competence_report($pr_report->parent) !!}</h3>
						</div>
						<div class="col-4">
							<p class=" mb-0  fs-12 text-muted">AVERAGE</p>
							<h3 class="mb-0">{{ round((avg_per_pr_objective($pr_report->parent)+avg_per_key_competence_report($pr_report->parent))/2) }} <span style="font-size: 14px;">{{ \App\Models\HumanResource\PerformanceReview\PrRateScale::whereRate(round((avg_per_pr_objective($pr_report->parent)+avg_per_key_competence_report($pr_report))/2))->first()->description }}</span></h3>
						</div>
					</div>
			</div>
		</div>
    </div>

</div>

<div class="row">
    @include('HumanResource.PerformanceReview.datatables.evaluation_objectives_show',['pr_objectives' => $pr_report->parent->objectives,'pr_report' => $pr_report])
 </div>

@if($pr_report->user->supervisor)
    @include('HumanResource.PerformanceReview.datatables.competence_show')
@else
    @include('HumanResource.PerformanceReview.datatables.attribute_show',['pr_objectives' => $pr_report->objectives])
@endif

