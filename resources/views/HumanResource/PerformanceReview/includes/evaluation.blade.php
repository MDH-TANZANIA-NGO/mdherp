<div class="row">

    @if($can_submit_challenges == 0)
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <a href="{{ route('hr.pr.submit',$pr_report) }}"
        onclick="event.preventDefault();
        document.getElementById('submit-to-supervisor').submit();"
         class="btn btn-primary float-right">Submit to a supervisor</a>
        {!! Form::open(['route'=>['hr.pr.submit', $pr_report->child], 'id' => 'submit-to-supervisor']) !!}
        {!! Form::close() !!}
    </div>
    @endif

    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="font-size: 16px; color:#000">{{ $pr_report->type->title }}</span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">Appraisal due on : {{ $pr_report->from_at }}</span>
		    <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> Completed on : {{ $pr_report->to_at }}</span>
		</div>
    </div>

</div>

<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">Objectives</h3>
		</div>
        <div class="card-body">
        @switch($pr_report->pr_type_id)
            @case(1)
                @include('HumanResource.PerformanceReview.datatables.evaluation_objectives',['pr_objectives' => $pr_report->objectives])
            @break
        @endswitch
        </div>
    </div>
 </div>