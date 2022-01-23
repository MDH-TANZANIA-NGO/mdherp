@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                {{--            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Pay</button>--}}
                <a href="" class="btn btn-outline-info" style="margin-left: 2%;">View Approved Requisition</a>

</div>
        </div>
    </div>

    @if($safari_advance->count() > 0)
    @include('finance.payments.safariShow')
    @elseif($program_activity->count() > 0)
    @include('finance.payments.programActivityShow')
    @endif
@endsection
