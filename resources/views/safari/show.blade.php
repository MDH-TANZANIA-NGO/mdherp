@extends('layouts.app')
@section('content')



<!-- start: page -->
<div class="row mb-2">
    <div class="col-lg-12">
        @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
    </div>
</div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Deposit</button>

            </div>

        </div>
    </div>


<!-- Message Modal -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="example-Modal3">Deposit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['safari.payment',$safari->uuid],'method'=>'POST']) !!}
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Payment Method:</label>
                <select class="form-control" name="payment_method">
                    <option value="tigopesa">Tigo Pesa</option>
                    <option value="bank">Bank Transfer</option>
                </select>
                </div>
                <div class="form-group" id="number" >
                    <label for="recipient-name" class="form-control-label">Account Number:</label>
                    {!! Form::text('number',null,['class'=>'form-control', 'placeholder'=>'0758698022 or 0J1468300300']) !!}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Amount Paid:</label>
                    {!! Form::number('payed_amount',null,['class'=>'form-control', 'placeholder'=>'100,000']) !!}
                </div>

                {!! Form::number('reference',$safari->id,['class'=>'form-control', 'hidden']) !!}
                {!! Form::number('requested_amount',$safari->amount_requested,['class'=>'form-control', 'hidden']) !!}
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Remarks:</label>
                    {!! Form::textarea('remarks',null,['class'=>'form-control', 'placeholder'=>'max 200 words']) !!}
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

</div>

@endsection


