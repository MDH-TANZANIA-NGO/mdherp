@extends('layouts.app')
@section('content')

    <!-- Row-->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('requisition.show', $requisition->uuid)}}"><h3 class="card-title">{{$requisition->number}}</h3></a>
                </div>
                <div class="card-body">
                    <div class="">
                        <h4 class="mb-1"><strong>{{$safari_advance->user->full_name_formatted}}</strong>,</h4>
                        Has Requested Safari Advance of  <strong>{{number_2_format($safari_advance->amount_requested)}}</strong> (TZS)
                    </div>

                    <div class="card-body pl-0 pr-0">
                        <div class="row">
                            <div class="col-sm-6">
                                <span>Safari Advance No.</span><br>
                                <a href="{{route('safari.show',$safari_advance->uuid)}}" ><strong>{{$safari_advance->number}}</strong></a>
                            </div>
                            <div class="col-sm-6 text-right">
                                <span>Requested Date</span><br>
                                <strong>{{date('d-M-Y', strtotime($safari_advance->created_at))}}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row pt-4">
                        <div class="col-lg-6 ">
                            <p class="h3">Safari Info</p>
                            <address>
                                Destination: {{$safari_advance->travellingCost->district->name}}<br>
                                Departure: {{date('d-M-Y', strtotime($safari_advance->from))}}<br>
                                Return: {{date('d-M-Y', strtotime($safari_advance->to))}}<br>

                            </address>
                        </div>
                        <div class="col-lg-6 text-right">
                            <p class="h3">Pay To</p>
                            <address>
                                {{$safari_advance->user->full_name_formatted}}<br>
                                {{$safari_advance->user->phone}}<br>
                                {{$safari_advance->user->email}}
                            </address>
                        </div>
                    </div>
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <tr class=" ">
                                <th class="text-center " style="width: 1%"></th>
                                <th>Travel Requirements</th>

                                <th class="text-right" style="width: 20%">Amount</th>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td>

                                    <p class="font-w600 mb-1">Accommodation <b class="text-danger text align-items-center" style="margin-left: 10%">@if($hotel_reserved->count() > 0) Hotel is pre-booked do not pay accommodation @endif</b></p>
                                </td>

                                <td class="text-right">
                                    {{$safari_advance_payment->accommodation}}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <p class="font-w600 mb-1">Meals and Incidentals</p>
                                </td>
                                <td class="text-right"> {{$safari_advance_payment->perdiem_total_amount}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <p class="font-w600 mb-1">Ticket Fair</p>
                                </td>
                                <td class="text-right">{{$safari_advance_payment->ticket_fair}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    <p class="font-w600 mb-1">Ontransit Allowance</p>
                                </td>
                                <td class="text-right">{{$safari_advance_payment->ontransit}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>
                                    <p class="font-w600 mb-1">Ground Transport To Airport</p>
                                </td>
                                <td class="text-right"> {{$safari_advance_payment->transportation}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>
                                    <p class="font-w600 mb-1">Other Cost</p>
                                </td>
                                <td class="text-right">{{$safari_advance_payment->other_cost}}</td>

                                <div class="text-muted">{{$travelling_cost->others_description}}</div>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-w600 text-right">Account No</td>
                                {!! Form::open(['route'=> ['finance.sendSafariPaymentForApproval', $payment->uuid],'method'=>'POST']) !!}
                                {!! Form::number('requisition_travelling_cost_id', $travelling_cost->id, ['class'=>'form-control','hidden'])  !!}
                                {!! Form::number('requisition_id', $requisition->id, ['class'=>'form-control','hidden'])  !!}
                                {!! Form::number('requested_amount', $requisition->amount, ['class'=>'form-control','hidden'])  !!}
                                {!! Form::number('safari_advance_id', $safari_advance->id, ['class'=>'form-control','hidden'])  !!}
                                {!! Form::number('region_id', $requisition->region_id, ['class'=>'form-control','hidden'])  !!}

                                <td class="text-right">{{$safari_advance_payment->account_no}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-w600 text-right">Total Amount </td>
                                <td class="font-weight-bold text-right"> {{$safari_advance_payment->disbursed_amount}}</td>


                            </tr>
                            <tr>
                                <td colspan="2" class="font-w800 text-right">Remarks:</td>
                                <td class="font-weight-bold text-right">
                                    {{$payment->remarks}}</td>
                            </tr>

                            <tr>
                                <td colspan="5" class="text-right">
                                    <button type="submit" class="btn btn-primary" ><i class="si si-paper-plane"></i> Send for Approval</button>
                                    <a href="{{route('finance.edit_safari_payment', $safari_advance->uuid)}}" class="btn btn-secondary"><i class="fa fa-edit"></i> Edit</a
                                </td>
                            </tr>
                            {!! Form::close() !!}
                        </table>
                    </div>
                    <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- End row-->

@endsection

@push('after-scripts')
    <script>
        $(function () {
            $("#id-1, #id-2, #id-3, #id-4,#id-5,#id-6").keyup(function () {
                $("#id-7").val(+$("#id-1").val() + +$("#id-2").val() + +$("#id-3").val()+ +$("#id-4").val()+ +$("#id-5").val()+ +$("#id-6").val());
            });
        });
    </script>
@endpush

    <!-- Row-->
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <a href="{{route('requisition.show', $requisition->uuid)}}"><h3 class="card-title">{{$requisition->number}}</h3></a>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="">--}}
{{--                        <h4 class="mb-1"><strong>{{$safari_advance->user->full_name_formatted}}</strong>,</h4>--}}
{{--                        Has Requested Safari Advance of  <strong>{{number_2_format($safari_advance->amount_requested)}}</strong> (TZS)--}}
{{--                    </div>--}}

{{--                    <div class="card-body pl-0 pr-0">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <span>Safari Advance No.</span><br>--}}
{{--                                <a href="{{route('safari.show',$safari_advance->uuid)}}" ><strong>{{$safari_advance->number}}</strong></a>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6 text-right">--}}
{{--                                <span>Requested Date</span><br>--}}
{{--                                <strong>{{date('d-M-Y', strtotime($safari_advance->created_at))}}</strong>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <div class="row pt-4">--}}
{{--                        <div class="col-lg-6 ">--}}
{{--                            <p class="h3">Safari Info</p>--}}
{{--                            <address>--}}
{{--                                Destination: {{$safari_advance->travellingCost->district->name}}<br>--}}
{{--                                Departure: {{date('d-M-Y', strtotime($safari_advance->from))}}<br>--}}
{{--                                Return: {{date('d-M-Y', strtotime($safari_advance->to))}}<br>--}}

{{--                            </address>--}}
{{--                        </div>--}}
{{--                        <div class="col-lg-6 text-right">--}}
{{--                            <p class="h3">Pay To</p>--}}
{{--                            <address>--}}
{{--                                {{$safari_advance->user->full_name_formatted}}<br>--}}
{{--                                {{$safari_advance->user->phone}}<br>--}}
{{--                                {{$safari_advance->user->email}}--}}
{{--                            </address>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="table-responsive push">--}}
{{--                        <table class="table table-bordered table-hover">--}}
{{--                            <tr class=" ">--}}
{{--                                <th class="text-center " style="width: 1%"></th>--}}
{{--                                <th>Travel Requirements</th>--}}
{{--                                <th class="text-right" style="width: 20%">Amount</th>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td class="text-center">1</td>--}}
{{--                                <td>--}}
{{--                                    <p class="font-w600 mb-1">Accommodation</p>--}}
{{--                                </td>--}}

{{--                                <td class="text-right">{{number_2_format($safari_advance->travellingCost->accommodation)}}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td class="text-center">2</td>--}}
{{--                                <td>--}}
{{--                                    <p class="font-w600 mb-1">Meals and Incidentals</p>--}}
{{--                                </td>--}}
{{--                                <td class="text-right">{{number_2_format($safari_advance->travellingCost->perdiem_total_amount)}}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td class="text-center">3</td>--}}
{{--                                <td>--}}
{{--                                    <p class="font-w600 mb-1">Ticket Fair</p>--}}
{{--                                </td>--}}
{{--                                <td class="text-right">{{number_2_format($safari_advance->travellingCost->ticket_fair)}}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td class="text-center">4</td>--}}
{{--                                <td>--}}
{{--                                    <p class="font-w600 mb-1">Ontransit Allowance</p>--}}
{{--                                </td>--}}
{{--                                <td class="text-right">{{number_2_format($safari_advance->travellingCost->ontransit)}}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td class="text-center">5</td>--}}
{{--                                <td>--}}
{{--                                    <p class="font-w600 mb-1">Ground Transport To Airport</p>--}}
{{--                                </td>--}}
{{--                                <td class="text-right">{{number_2_format($safari_advance->travellingCost->transportation)}}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td class="text-center">6</td>--}}
{{--                                <td>--}}
{{--                                    <p class="font-w600 mb-1">Ticket Fair</p>--}}
{{--                                </td>--}}
{{--                                <td class="text-right">{{number_2_format($safari_advance->travellingCost->other_cost)}}</td>--}}

{{--                                <div class="text-muted">{{$safari_advance->travellingCost->others_description}}</div>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td colspan="2" class="font-w600 text-right">Account No</td>--}}
{{--                                {!! Form::open(['route'=> ['finance.sendSafariPaymentForApproval', $payment->uuid],'method'=>'POST']) !!}--}}
{{--                                {!! Form::number('requisition_id', $requisition->id, ['class'=>'form-control','hidden'])  !!}--}}
{{--                                {!! Form::number('requested_amount', $requisition->amount, ['class'=>'form-control','hidden'])  !!}--}}
{{--                                {!! Form::number('safari_advance_id', $safari_advance->id, ['class'=>'form-control','hidden'])  !!}--}}
{{--                                {!! Form::number('region_id', $requisition->region_id, ['class'=>'form-control','hidden'])  !!}--}}

{{--                                <td class="text-right">{{$safari_advance_payment->account_no}}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td colspan="2" class="font-w600 text-right">Total Amount Requested</td>--}}
{{--                                <td class="font-weight-bold text-right">{{number_2_format($safari_advance->travellingCost->total_amount)}}</td>--}}
{{--                            </tr>--}}
{{--                            <tr>--}}
{{--                                <td colspan="2" class="font-w600 text-right">Total Amount Paid </td>--}}
{{--                                <td class="font-weight-bold text-right">{{number_2_format($safari_advance_payment->disbursed_amount)}}</td>--}}
{{--                            </tr>--}}


{{--                            <tr>--}}
{{--                                <td colspan="5" class="text-right">--}}
{{--                                    <button type="submit" class="btn btn-primary" ><i class="si si-paper-plane"></i> Send for Approval</button>--}}
{{--                                    <a href="{{route('finance.edit_safari_payment', $safari_advance->uuid)}}" class="btn btn-secondary"><i class="fa fa-edit"></i> Edit</a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                            {!! Form::close() !!}--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                    <p class="text-muted text-center">Please verify amount paid before submit for approval!</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- End row-->



{{--@endsection--}}
