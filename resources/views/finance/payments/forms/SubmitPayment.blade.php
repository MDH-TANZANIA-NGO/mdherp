@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
    {!! Form::open(['route'=> ['finance.update', $payment],'method'=>'POST']) !!}
    <button type="submit"  class="btn btn-outline-success" style="margin-left: 2%;"  >Submit For Approval</button>
    {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">PAYMENT SUMMARY</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">

    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap">
            <thead >
            <tr>

                <th>Requisition Number</th>
                @if($travelling_details->count() > 0)
                    Safari Advance number
                @elseif ($training_details->count() > 0)
                    <th>Activity Number</th>
                    @endif

                <th>Requested Amount</th>
                <th>Paid Amount</th>
                <th>Remaining Balance</th>

            </tr>
            </thead>
            <tbody>
            <td>{{$requisition->number}}</td>
            @if($travelling_details->count() > 0)
                <td>{{$safari_advance->number}}</td>
            @elseif($training_details->count())
                <td>{{$program_activity->number}}</td>
            @endif
            <td>{{number_2_format($requisition->amount)}}</td>
            <td>{{number_2_format($payed_amount)}}</td>
            <td>{{number_2_format($requisition->amount -  $payed_amount)}}</td>
            </tbody>
        </table>
    </div>
            </div>
        </div>
    </div>


@endsection
