@extends('layouts.app')
@section('content')
    @switch($pr_report->type->id)
        @case(2)
            @if($pr_report->parent)
                @include('HumanResource.PerformanceReview.includes.evaluation',['pr_report' => $pr_report->parent])
            @else
                @include('HumanResource.PerformanceReview.includes.report',['pr_report' => $pr_report])
            @endif
        @break
        @case(1)
        @if($pr_report->parent)
                @include('HumanResource.PerformanceReview.includes.probation_evaluation',['pr_report' => $pr_report->parent])
            @else
                @include('HumanResource.PerformanceReview.includes.report',['pr_report' => $pr_report])
            @endif
        @break
    @endswitch

    @if($pr_report->user_id == access()->id())
        @if($pr_report->user->supervisor)
            @include('HumanResource.PerformanceReview.datatables.competence_saved')
        @else
            @include('HumanResource.PerformanceReview.datatables.attribute_saved')
        @endif
    @endif

@endsection