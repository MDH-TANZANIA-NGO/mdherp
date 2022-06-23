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

@if($pr_report->type_id == 2)
    @if($pr_report->remarks()->count())
        @include('HumanResource.PerformanceReview.datatables.remarks')
    @endif
    @include('HumanResource.PerformanceReview.form.remark')
@endif

<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">
                @switch($pr_report->pr_type_id)
                    @case(2) D. WORK PERFORMANCE GOALS FOR COMING YEAR @break
                    @case(1) D. EXPECTED ACHIEVEMENTS DURING PROBATION @break
                @endswitch
            </h3>
		</div>
        <div class="card-body">
        @if(\App\Models\HumanResource\PerformanceReview\PrRemark::query()->where('pr_report_id',$pr_report->id)->count() && $pr_report->user_id == access()->id() &&  $pr_report->completed == 0)
                @include('HumanResource.PerformanceReview.form.next_objective',['pr_report' => $pr_report])
            @endif
            @include('HumanResource.PerformanceReview.datatables.next_objectives',['pr_next_objectives' => $pr_report->nextObjectives])
        </div>
    </div>
 </div>

@switch($pr_report->pr_type_id)
    @case(2)
        @if($pr_report->skill()->count())
            @include('HumanResource.PerformanceReview.datatables.skills')
        @endif

        @if($pr_report->education()->count())
            @include('HumanResource.PerformanceReview.datatables.education')
        @endif


        @if(\App\Models\HumanResource\PerformanceReview\PrRemark::query()->where('pr_report_id',$pr_report->id)->count() && $pr_report->user_id == access()->id() &&  $pr_report->completed == 0)
            @include('HumanResource.PerformanceReview.form.skill')
            @include('HumanResource.PerformanceReview.form.education')
        @endif
    @break
    @case(1)
        @if($can_update_attribute_rate_resource)
            @include('HumanResource.PerformanceReview.form.achievement_comment')
            @include('HumanResource.PerformanceReview.form.recommendation')
        @else
            @include('HumanResource.PerformanceReview.datatables.achievement_comment')
            @include('HumanResource.PerformanceReview.datatables.recommendation')
        @endif
    @break
@endswitch

