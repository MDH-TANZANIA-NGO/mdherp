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
						<label class="form-label">3 Monthly Appraisal due on</label>
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

@endsection