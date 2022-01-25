@extends('layouts.app')
@section('content')
    @if($payment->done == 0)
    {!! Form::open(['route'=> ['finance.update', $payment],'method'=>'POST']) !!}
    <button type="submit"  class="btn btn-outline-info" style="margin-left: 2%;"  >Submit For Approval</button>
    {!! Form::close() !!}
    @else
        @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
@endif


@endsection
