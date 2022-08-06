<div class="row">
        @if($can_be_processed_for_evaluation)
            <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12">
                <a href="{{ route('hr.pr.evaluation.initiate', $pr_report) }}"
                onclick="event.preventDefault();
                document.getElementById('initiate-pr-evaluation').submit();"
                class="btn btn-warning float-right">Initiate Goals/Objectives for Evaluation
                </a>
                {!! Form::open(['route'=>['hr.pr.evaluation.initiate', $pr_report], 'id' => 'initiate-pr-evaluation']) !!}
                {!! Form::close() !!}
            </div>
        @endif
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="font-size: 16px; color:#000">{{ $pr_report->type->title }}</span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">Appraisal due on : {{ $pr_report->from_at }}</span>
		    <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> Completed on : {{ $pr_report->to_at }}</span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> Number : {{ $pr_report->number }}</span>
		</div>
    </div>

</div>

<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">
                @switch($pr_report->type->id)
                    @case(1)
                        INITIAL MEETING
                    @break
                    @case(2)
                        Objectives
                    @break
                @endswitch
            </h3>
		</div>
        <div class="card-body">
            @switch($pr_report->type->id)
                @case(2)
                    @if($can_edit_resource)
                        @include('HumanResource.PerformanceReview.form.objective',['pr_report' => $pr_report])
                    @endif
                    @include('HumanResource.PerformanceReview.datatables.objectives_show',['pr_objectives' => $pr_objectives])
                @break
                @case(1)
                    @if($can_edit_resource)
                        @include('HumanResource.PerformanceReview.form.probation_objective',['pr_report' => $pr_report])
                    @endif
                    @include('HumanResource.PerformanceReview.datatables.objectives_show',['pr_objectives' => $pr_objectives])
                @break
            @endswitch
        </div>
    </div>
 </div>