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
                @include('HumanResource.PerformanceReview.includes.evaluation',['pr_report' => $pr_report->parent])
            @else
                @include('HumanResource.PerformanceReview.includes.probation_report',['pr_report' => $pr_report])
            @endif
        @break
    @endswitch
@endsection