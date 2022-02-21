@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">
                @if($payment->done == 0)
                    {!! Form::open(['route'=> ['finance.update', $payment],'method'=>'POST']) !!}
                    <button type="submit"  class="btn btn-outline-success" style="margin-left: 2%;"  >Submit For Approval</button>

                    {!! Form::close() !!}
                 @endif
                    <button type="button" data-toggle="modal" data-target="#exampleModal1" class="btn btn-outline-info" style="margin-left: 2%;"  >Edit Payment</button>


            </div>
        </div>

    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="example-Modal3">Update Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route'=> ['finance.updatePayment', $payment->uuid],'method'=>'POST']) !!}
                    <label for="recipient-name" class="form-control-label">Pay To:</label>
                    {!! Form::number('phone', $payment->account_number, ['class'=>'form-control'])  !!}
                    <label for="recipient-name" class="form-control-label">Total Amount:</label>
                    <input type="number" class="form-control" name="total_amount" value="{{$payment->payed_amount}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary" >Verify</button>
                    </div>

                    {!! Form::close() !!}
                </div>
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
                @if($safari_advance)
                    <th>Safari Advance number</th>
                @elseif ($program_activity)
                    <th>Activity Number</th>
                    @endif

                <th>Requested Amount</th>
                <th>Paid Amount</th>
                <th>Variance</th>

            </tr>
            </thead>
            <tbody>
            <td>{{$requisition->number}}</td>
            @if($safari_advance)
                <td>{{$safari_advance->number}}</td>
            @elseif($program_activity)
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
