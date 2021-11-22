@extends('layouts.app')
@section('content')
    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>

    <div class="row">
        <div class="col-12">

        </div>
    </div>

@endsection
