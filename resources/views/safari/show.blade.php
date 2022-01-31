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
            {{--            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Pay</button>--}}
            <a href=" {{route('requisition.show', $safari->travellingCost->requisition->uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">View Approved Requisition</a>

        </div>

    </div>
</div>


<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SAFARI ADVANCE SUMMARY</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
{{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
            </div>
        </div>
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Scope</h5>
                    </div>
                    <p class="mb-1">{{$safari->scope}}</p>
                </a>

            </div>

            <hr>


            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead >
                    <tr>

                        <th>Destination</th>
                        <th>Start Date</th>
                        <th>Return Date</th>
                        <th>Perdiem</th>
                        <th>Accommodation</th>
                        <th>Transport</th>
                        <th> Means</th>
                        <th>On Transit</th>
                        <th>Others</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($safari_details as $costs)
                        <tr>

                            <td>{{$safari->travellingCost->district->name}}</td>
                            <td>{{$costs->from}}</td>
                            <td>{{$costs->to}}</td>
                            <td>{{number_2_format($costs->perdiem)}}</td>
                            <td>{{number_2_format($costs->accommodation)}}</td>
                            <td>{{number_2_format($costs->transportation)}}</td>
                            <td>{{$costs->transport_means}}</td>
                            <td>{{number_2_format($costs->ontransit)}}</td>
                            <td>{{number_2_format($costs->other_costs)}}</td>
                            <td>{{number_2_format($safari->travellingCost->total_amount)}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
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
                <select class="form-control" name="payment_method" >
                    <option value="tigopesa">Tigo Pesa</option>
{{--                    <option value="bank">Bank Transfer</option>--}}
                </select>
                </div>
                <div class="form-group" id="number" >
                    <label for="recipient-name" class="form-control-label">Account Number:</label>
                    {!! Form::text('number',$safari->travellingCost->user->phone,['class'=>'form-control', 'placeholder'=>'0758698022 or 0J1468300300']) !!}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Amount Paid:</label>
                    {!! Form::number('payed_amount',$safari->travellingCost->total_amount,['class'=>'form-control', 'placeholder'=>'100,000', 'id'=>'paid_amount']) !!}
                </div>

                {!! Form::number('reference',$safari->id,['class'=>'form-control', 'hidden']) !!}
                {!! Form::number('requested_amount',$safari->amount_requested,['class'=>'form-control', 'hidden', 'id'=>'requested_amount']) !!}
                <div class="form-group">
                    <label for="recipient-name" class="form-control-label">Remarks:</label>
                    {!! Form::textarea('remarks',null,['class'=>'form-control', 'placeholder'=>'max 200 words']) !!}
                </div>




            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

</div>

@endsection



