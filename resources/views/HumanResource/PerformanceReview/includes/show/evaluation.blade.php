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
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">Objectives</h3>
		</div>
        <div class="card-body">
        @switch($pr_report->parent->pr_type_id)
            @case(1)
                @include('HumanResource.PerformanceReview.datatables.evaluation_objectives_show',['pr_objectives' => $pr_report->parent->objectives])
            @break
        @endswitch
        </div>
    </div>
 </div>