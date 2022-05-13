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
                                Departure: {{date('d-M-Y', strtotime($safari_advance->safariDetails->from))}}<br>
                                Return: {{date('d-M-Y', strtotime($safari_advance->safariDetails->to))}}<br>

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
                                {!! Form::open(['route'=> 'finance.store_safari_payment','method'=>'POST']) !!}
                                <th class="text-right" style="width: 20%">Amount</th>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td>

                                    <p class="font-w600 mb-1">Accommodation <b class="text-danger text align-items-center" style="margin-left: 10%">@if($hotel_reserved->count() > 0) Hotel is prebooked do not pay accommodation @endif</b></p>
                                </td>

                                <td class="text-right">
                                    @if($hotel_reserved->count() > 0) {!! Form::number('accommodation', 0.00, ['class'=>'form-control','id'=>'id-1'])  !!}
                                    @else
                                    {!! Form::number('accommodation', $safari_advance->travellingCost->accommodation, ['class'=>'form-control','id'=>'id-1'])  !!}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <p class="font-w600 mb-1">Meals and Incidentals</p>
                                </td>
                                <td class="text-right"> {!! Form::number('perdiem_total_amount', $safari_advance->travellingCost->perdiem_total_amount, ['class'=>'form-control','id'=>'id-2'])  !!}</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <p class="font-w600 mb-1">Ticket Fair</p>
                                </td>
                                <td class="text-right"> {!! Form::number('ticket_fair', $safari_advance->travellingCost->ticket_fair, ['class'=>'form-control','id'=>'id-3'])  !!}</td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>
                                    <p class="font-w600 mb-1">Ontransit Allowance</p>
                                </td>
                                <td class="text-right"> {!! Form::number('ontransit', $safari_advance->travellingCost->ontransit, ['class'=>'form-control','id'=>'id-4'])  !!}</td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>
                                    <p class="font-w600 mb-1">Ground Transport To Airport</p>
                                </td>
                                <td class="text-right"> {!! Form::number('transportation', $safari_advance->travellingCost->transportation, ['class'=>'form-control','id'=>'id-5'])  !!}</td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>
                                    <p class="font-w600 mb-1">Other Cost</p>
                                </td>
                                <td class="text-right"> {!! Form::number('other_cost', $safari_advance->travellingCost->other_cost, ['class'=>'form-control','id'=>'id-6'])  !!}</td>

                                <div class="text-muted">{{$safari_advance->travellingCost->others_description}}</div>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-w600 text-right">Account No</td>

                                {!! Form::number('requisition_id', $requisition->id, ['class'=>'form-control','hidden'])  !!}
                                {!! Form::number('requested_amount', $requisition->amount, ['class'=>'form-control','hidden'])  !!}
                                {!! Form::number('safari_advance_id', $safari_advance->id, ['class'=>'form-control','hidden'])  !!}
                                {!! Form::number('region_id', $requisition->region_id, ['class'=>'form-control','hidden'])  !!}

                                <td class="text-right">{!! Form::text('phone', $safari_advance->user->phone, ['class'=>'form-control'])  !!}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-w600 text-right">Total Amount </td>
                                <td class="font-weight-bold text-right">  {!! Form::number('total_amount', null, ['class'=>'form-control','id'=>'id-7','required'])  !!}</td>


                            </tr>
                            <tr>
                                <td colspan="2" class="font-w800 text-right">Remarks:</td>
                                <td class="font-weight-bold text-right">
                                    {!! Form::text('remarks', null, ['class'=>'form-control'])  !!}</td>
                            </tr>

                            <tr>
                                <td colspan="5" class="text-right">
                                    <button type="submit" class="btn btn-primary" ><i class="si si-wallet"></i> Pay Safari</button>
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
