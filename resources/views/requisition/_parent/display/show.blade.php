@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <p class="text-center" style="font-size: 18px"><b>{{ $requisition->number }}</b></p>
        </div>
    </div>
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>

    @switch($requisition->requisition_type_id)
        @case(1)
        @include('requisition.procurement.details',['items' => $requisition->items])
        @break
    @endswitch

@endsection
