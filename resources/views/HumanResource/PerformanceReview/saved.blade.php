@extends('layouts.app')
@section('content')
    <!-- @include('HumanResource.PerformanceReview.form.probation') -->
<div class="row">

    <div class="card">
        <div class="card-header">
			<h3 class="card-title">{{ $pr_report->type->title }}</h3>
		</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">Appraisal due on</label>
						<p>{{ $pr_report->from_at }}</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">Completed on</label>
						<p>{{ $pr_report->to_at }}</p>
                    </div>
                </div>
            </div>
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
                @include('HumanResource.PerformanceReview.form.objective',['pr_report' => $pr_report])
                @include('HumanResource.PerformanceReview.datatables.objectives',['pr_report' => $pr_report])
            @break
        @endswitch
        </div>
    </div>
 </div>
@endsection