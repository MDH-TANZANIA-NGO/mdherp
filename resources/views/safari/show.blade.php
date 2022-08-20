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
                                <h3 class="mb-0">{{$transport_means->type}}</h3>
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
{{--            <th>NO</th>--}}
            <th>Hotel Name</th>
{{--            <th>Priority Level</th>--}}
            <th>Status</th>
            @permission('admin_panel')
            @if($safari->wf_done ==  1)
            <th>Action</th>
            @endif
            @endpermission
        </tr>
        </thead>
        <tbody>
        @foreach($hotels_reserved as $hotels)
        <tr>

                    <td>{{$hotels->name}}</td>
                    <td>
                        @if($hotels->reserved == false)
                            Not reserved
                        @else
                            Reserved
                        @endif
                    </td>
                    @permission('admin_panel')
            @if($safari->wf_done == 1)
                    <td>

                        @if($hotels->reserved == false)
                            <a href="{{route('safari.reserveHotel', $hotels->uuid)}}" onclick="if (confirm('Are you sure you want to book?')){return true} else {return false}"><span class="btn btn-sm btn-primary"><i class="fe fe-check-square"></i>Book</span></a>
                        @else
                            <a  href="{{route('safari.reserveHotel', $hotels->uuid)}}"><span class="btn btn-sm btn-primary"><i class="fa fa-undo"></i>Undo</span></a>
                        @endif

                    </td>
            @endif
                    @endpermission

        </tr>
        @endforeach
        </tbody>
    </table>
</div>
            </div>
        </div>
    </div>
<!--End Row-->


<div class="row">
    @foreach($travelling_costs as $cost)

        <div class="card">
            <div class="card-header">
                <div class="tags">

                    <div class="tag">
                        Traveller's name
                        <span class="tag-addon tag-success">{{$cost->user->first_name}} {{$cost->user->last_name}}</span>
                    </div>
                    <div class="tag tag-default" data-toggle="modal" data-target="#exampleModal">
                        {{$cost->from}}
                        <span class="tag-addon"><i class="fe fe-calendar"></i></span>
                    </div>
                    <div class="tag tag-default" data-toggle="modal" data-target="#exampleModal">
                        {{$cost->to}}
                        <span class="tag-addon"><i class="fe fe-calendar"></i></span>
                    </div>

                    <div class="tag">
                        Total travelling cost
                        <span class="tag-addon tag-success">{{number_2_format($cost->total_amount)}}</span>
                    </div>
                    <div class="tag">
                        Total perdiem
                        <span class="tag-addon tag-success">{{number_2_format($cost->perdiem_total_amount)}}</span>
                    </div>
                    <div class="tag">
                        Total accommodation
                        <span class="tag-addon tag-success">{{number_2_format($cost->accommodation)}}</span>
                    </div>
                    <div class="tag">
                        Ontransit
                        <span class="tag-addon tag-success">{{number_2_format($cost->ontransit)}}</span>
                    </div>

                </div>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                @if($cost->trips->count() > 0)
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class="text-center" >Destination</th>
                                <th class="text-center" >Departure</th>
                                <th class="text-center" >Returning</th>
                                <th class="text-right" style="width: 1%">Perdiem</th>
                                <th class="text-right" style="width: 2%">Ticket</th>
                                <th class="text-right" style="width: 1%">Accomodation</th>
                                <th class="text-right" style="width: 1%">Transportation</th>
                                <th class="text-right" style="width: 1%">Others</th>
                                <th class="text-right" style="width: 1%">Total</th>
                            </tr>

                            @foreach($cost->trips as $trips)
                                <tr>
                                    <td>
                                        <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>{{$trips->district->name}}</div>
                                    </td>
                                    <td class="text-center">{{ date('d-M-Y', strtotime($trips->from)) }}</td>
                                    <td class="text-center">{{ date('d-M-Y', strtotime($trips->to)) }}</td>
                                    <td class="text-right">{{ number_2_format($trips->perdiem_total_amount )}}</td>
                                    <td class="text-right">{{ number_2_format($trips->ticket_fair )}}</td>
                                    <td class="text-right">{{ number_2_format($trips->total_accommodation )}}</td>
                                    <td class="text-right">{{ number_2_format($trips->transportation) }}</td>
                                    <td class="text-right">{{ number_2_format($trips->other_cost) }}   <div class="nn" style="color: green">{{ $trips->others_description }}</div></td>

                                    <td class="text-right">{{ number_2_format($trips->total_amount) }}</td>
                                </tr>
                            @endforeach

                            {{--                        <tr>--}}
                            {{--                            <td colspan="6" class="font-w600 text-right">Total TZS</td>--}}
                            {{--                            <td class="text-right">240,000.00</td>--}}
                            {{--                        </tr>--}}
                            <tr>
                                <td colspan="8" class="font-weight-regular text-uppercase text-right">Sub Total </td>
                                <td class="font-weight-regular text-right">{{ number_2_format($cost->total_amount) }}</td>
                            </tr>

                        </table>
                    </div>
                @else
                    {{--                    {{$cost}}--}}
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th class="text-center" >Destination</th>
                                <th class="text-center" >Departure</th>
                                <th class="text-center" >Returning</th>
                                <th class="text-right" style="width: 1%">Perdiem</th>
                                <th class="text-right" style="width: 2%">Ticket</th>
                                <th class="text-right" style="width: 1%">Accomodation</th>
                                <th class="text-right" style="width: 1%">Transportation</th>
                                <th class="text-right" style="width: 1%">Others</th>
                                <th class="text-right" style="width: 1%">Total</th>
                            </tr>

                            <tr>
                                <td>
                                    <div class="nn" style="color: green"><i class="fe fe-map-pin"></i>{{$cost->district->name}}</div>
                                </td>
                                <td class="text-center">{{ date('d-M-Y', strtotime($cost->from)) }}</td>
                                <td class="text-center">{{ date('d-M-Y', strtotime($cost->to)) }}</td>
                                <td class="text-right">{{ number_2_format($cost->perdiem_total_amount )}}</td>
                                <td class="text-right">{{ number_2_format($cost->ticket_fair )}}</td>
                                <td class="text-right">{{ number_2_format($cost->accommodation )}}</td>
                                <td class="text-right">{{ number_2_format($cost->transportation) }}</td>
                                <td class="text-right">{{ number_2_format($cost->other_cost) }}   <div class="nn" style="color: green">{{ $cost->others_description }}</div></td>

                                <td class="text-right">{{ number_2_format($cost->total_amount) }}</td>
                            </tr>

                            <tr>
                                <td colspan="8" class="font-weight-regular text-uppercase text-right">Total </td>
                                <td class="font-weight-regular text-right">{{ number_2_format($cost->total_amount) }}</td>
                            </tr>

                        </table>
                    </div>
                @endif
            </div>
        </div>


    @endforeach
</div>





@endsection



