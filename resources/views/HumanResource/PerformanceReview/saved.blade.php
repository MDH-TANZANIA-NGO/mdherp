@extends('layouts.app')
@section('content')
    @if($pr_report->parent)
        @include('HumanResource.PerformanceReview.includes.evaluation')
    @else
        @include('HumanResource.PerformanceReview.includes.report')
    @endif
@endsection