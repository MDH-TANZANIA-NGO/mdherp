@extends('layouts.app')
@section('content')



<!-- start: page -->
<div class="row mb-2">
    <div class="col-lg-12">
        @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
    </div>
</div>

{{--<div class="row">
    <div class="card">
        <div class="card-header">
            --}}{{--            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Pay</button>--}}{{--
            <a href=" {{route('requisition.show', $safari->travellingCost->requisition->uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">View Approved Requisition</a>

        </div>

    </div>
</div>--}}

<!--Row-->
<div class="row">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">  <a href=" {{route('requisition.show', $safari->travellingCost->requisition->uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">{{$safari->travellingCost->requisition->number}}</a>
                </h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                @foreach($safari_details as $details)
                <div class="card">
                    <div class="p-3">
                        <h3 class="card-title mb-2">Safari to: <b>{{$details->district->name}}</b></h3>
                        <div class="row">
                            <div class="col-4 border-right">
                                <p class=" mb-0 fs-12  text-muted">Departure</p>
                                <h3 class="mb-0">{{\Carbon\Carbon::parse($details->from)->format('D d-M-Y')}}</h3>
                            </div>
                            <div class="col-4 border-right ">
                                <p class=" mb-0 fs-12 text-muted">Returning</p>
                                <h3 class="mb-0">{{\Carbon\Carbon::parse($details->to)->format('D d-M-Y')}}</h3>
                            </div>
                            <div class="col-4">
                                <p class=" mb-0  fs-12 text-muted">Transport means</p>
                                <h3 class="mb-0">{{$details->transport_means}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Scope</h5>
                            </div>
                            <p class="mb-1">{!! html_entity_decode($safari->scope) !!}</p>
                        </a>

                    </div>
                <br>
                <div class="">
                    <div class="table-responsive">
                        <table class="table mb-0 table-vcenter table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Item</th>
                                <th></th>
                                <th>Total Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><i class="fa fa-bed"></i></td>
                                <td>Accommodation</td>
                                <td>{{number_2_format($details->accommodation)}}</td>

                            </tr>
                            <tr>
                                <td><i class="fa fa-cutlery"></i></td>
                                <td>Meals and Incidentals</td>
                                <td>{{number_2_format($details->perdiem)}}</td>

                            </tr>
                            <tr>
                                <td><i class="fa fa-subway"></i></td>
                                <td>On transit</td>
                                <td>{{number_2_format($details->ontransit)}}</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-taxi"></td>
                                <td>Ground Transportation</td>
                                <td>{{number_2_format($details->transportation)}}</td>
                            </tr>

                            <tr>
                                <td><i class="fa fa-exclamation"></i></td>
                                <td>Other Cost</td>
                                <td>{{number_2_format($details->other_costs)}}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
<!-- Row -->
<div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hotel Reservation</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body text-center">
<div class="table-responsive">
    <table class="table  table-bordered border-left-0 border-right-0 text-nowrap border-bottom-0 mb-0">
        <thead>
        <tr>
            <th>NO</th>
            <th>Hotel Name</th>
            <th>Priority Level</th>
            <th>Status</th>
            @permission('admin_panel')
            <th>Action</th>
            @endpermission
        </tr>
        </thead>
        <tbody>

        <tr>
            @if($hotels_reserved->count() > 0)
                @foreach($hotels_reserved as $key=>$hotels)

                    <td>{{ $key + 1 }}</td>
                    <td>{{$hotels->name}}</td>
                    <td>     @if($hotels->priority_level == 1)
                            First
                        @elseif($hotels->priority_level == 2)
                            Second
                        @elseif($hotels->priority_level == 3)
                            Third
                        @elseif($hotels->priority_level == 4)
                            Fourth
                        @endif
                    </td>
                    <td>
                        @if($hotels->reserved == false)
                            Not reserved
                        @else
                            Reserved
                        @endif
                    </td>
                    @permission('admin_panel')
                    <td>

                        @if($hotels->reserved == false)
                            <a href="{{route('safari.reserveHotel', $hotels->uuid)}}" onclick="if (confirm('Are you sure you want to book?')){return true} else {return false}"><span class="btn btn-sm btn-primary"><i class="fe fe-check-square"></i>Book</span></a>
                        @else
                            <a  href="{{route('safari.reserveHotel', $hotels->uuid)}}"><span class="btn btn-sm btn-primary"><i class="fa fa-undo"></i>Undo</span></a>
                        @endif
                    </td>
                    @endpermission
                @endforeach
            @else
                No Hotel reserved

            @endif
        </tr>

        </tbody>
    </table>
</div>
            </div>
        </div>
    </div>
<!--End Row-->

{{--<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">SAFARI ADVANCE SUMMARY</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
--}}{{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}{{--
            </div>
        </div>
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Scope</h5>
                    </div>
                    <p class="mb-1">{!! html_entity_decode($safari->scope) !!}</p>
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
--}}{{--                    <option value="bank">Bank Transfer</option>--}}{{--
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

</div>--}}

@endsection



