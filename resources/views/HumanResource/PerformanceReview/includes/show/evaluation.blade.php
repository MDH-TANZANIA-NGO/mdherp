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

</div>

<div class="row">
    @include('HumanResource.PerformanceReview.datatables.evaluation_objectives_show',['pr_objectives' => $pr_report->parent->objectives,'pr_report' => $pr_report])
 </div>

@if($pr_report->user->supervisor)
    @include('HumanResource.PerformanceReview.datatables.competence_show')
@else
    @include('HumanResource.PerformanceReview.datatables.attribute_show',['pr_objectives' => $pr_report->objectives])
@endif

@include('HumanResource.PerformanceReview.datatables.overall_summary')

@if($pr_report->remarks)
    @include('HumanResource.PerformanceReview.datatables.remarks')
@endif

@if($pr_report->remarks()->count() == 0 && $pr_report->supervisor_id == access()->id())
	@if($can_update_attribute_rate_resource)
        @include('HumanResource.PerformanceReview.form.remark')
    @endif
@endif