@extends('layouts.app')
@section('content')
    @if($pr_report->parent)
        @include('HumanResource.PerformanceReview.includes.evaluation',['pr_report' => $pr_report->parent])
    @else
        @include('HumanResource.PerformanceReview.includes.report',['pr_report' => $pr_report])
    @endif
@endsection