@extends('layouts.app')
@section('content')

    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>

    @if($pr_report->parent)
        @include('HumanResource.PerformanceReview.includes.show.evaluation')
    @else
        @include('HumanResource.PerformanceReview.includes.show.objectives')
    @endif

@endsection