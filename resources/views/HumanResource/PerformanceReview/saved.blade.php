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
                @include('HumanResource.PerformanceReview.includes.probation_report',['pr_report' => $pr_report])
            @endif
        @break
    @endswitch

    @if($pr_report->parent)
    
        @if($pr_report->user->supervisor)
            @include('HumanResource.PerformanceReview.datatables.competence_saved')
        @else
            @include('HumanResource.PerformanceReview.datatables.attribute_saved')
        @endif

        @switch($pr_report->type->id)
            @case(1)
                @include('HumanResource.PerformanceReview.form.next_objective_saved')
                @include('HumanResource.PerformanceReview.datatables.next_objectives',['pr_next_objectives' => $pr_report->nextObjectives])
            @break
        @endswitch
    @endif
@endsection