@extends('layouts.app')
@section('content')


    <div class="align-content-center" style="background-color: rgb(238, 241, 248); height: 40px;">
        <div class="row text-center" style="font-size: large">
            <span class="col-12 text-center font-weight-bold" style="margin-top: 10px"><b>Requisition No.  {{ $requisition->number }}</b></span>
        </div>
    </div>

    <!-- start: page -->
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>
    @include('requisition._parent.includes.general_summary')
    @switch($requisition->requisition_type_id)
        @case(1)
        @include('requisition.procurement.details',['items' => $requisition->items])
        @break
        @case(2)
        @switch($requisition->requisition_type_category)
            @case(1)
            @include('requisition.Direct.travelling.show')
            @break
            @case(2)
            @include('requisition.Direct.training.show',['trainings' => $training_costs])
            @break
        @endswitch
        @break
    @endswitch

@endsection
