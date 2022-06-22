@extends('layouts.app')
@section('content')
    @if($pr_report->parent)
    @if($pr_report->completed == 1)
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>
    @endif
        @include('HumanResource.PerformanceReview.includes.show.evaluation')
    @else
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>
        @include('HumanResource.PerformanceReview.includes.show.objective')
    @endif

@endsection