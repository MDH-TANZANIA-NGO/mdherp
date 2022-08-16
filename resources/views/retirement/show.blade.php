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
                <a href="{{ url()->previous() }}" class="btn btn-outline-info">Back</a>
{{--                <a href="{{ url()->previous() }}" class="btn btn-info btn-arrow-right">Back</a>--}}
                &nbsp;&nbsp;
                <h3 class="card-title">Retirement Summary</h3>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">

                <div class="list-group">
                    <div class="list-group-item list-group-item-action flex-column align-items-start">

                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><b>Background Information:</b></h5>
                            </div>

                            <p class="mb-1">{{$retirement->details->activity_report}}</p>

                            &nbsp;

                    </div>


                </div>

            </div>

            <hr>


                <div class="card-body">

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
                                @foreach($retirementz as $retirement)
                                <tr>
                                    <td><i class="fa fa-bed"></i></td>
                                    <td>Accommodation</td>
                                    <td>{{number_2_format($retirement->accomodation)}}</td>
                                    {{-- Accomodation attachment--}}
                                    @if($retirement->getFirstMediaUrl('accomodation_attachments'))
                                        <td><a href="{{$retirement->getFirstMediaUrl('accomodation_attachments')}}" class="btn btn-outline-info btn-sm mb-1" target="_blank">View attachment</a></td>
                                    @else
                                        <td></td>
                                    @endif

                                </tr>
                                <tr>
                                    <td><i class="fa fa-cutlery"></i></td>
                                    <td>Meals and Incidentals</td>
                                    <td>{{number_2_format($retirement->perdiem_total_amount)}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td><i class="fa fa-subway"></i></td>
                                    <td>On transit</td>
                                    <td>{{number_2_format($retirement->ontransit)}}</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-ticket"></i></td>
                                    <td>Ticket Fair</td>
                                    <td>{{number_2_format($retirement->ticket_fair)}}</td>
                                    {{-- Ticket fair attachment--}}
                                    @if($retirement->getFirstMediaUrl('ticket_attachments'))
                                        <td><a href="{{$retirement->getFirstMediaUrl('ticket_attachments')}}" class="btn btn-outline-info btn-sm mb-1" target="_blank">View attachment</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><i class="fa fa-taxi"></i></td>
                                    <td>Ground Transportation</td>
                                    <td>{{number_2_format($retirement->transportation)}}</td>
                                    {{-- Ground Transport attachment--}}
                                    @if($retirement->getFirstMediaUrl('transportation_attachments'))
                                        <td><a href="{{$retirement->getFirstMediaUrl('transportation_attachments')}}" class="btn btn-outline-info btn-sm mb-1" target="_blank">View attachment</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>

                                <tr>
                                    <td><i class="fa fa-exclamation"></i></td>
                                    <td>Other Cost</td>
                                    <td>{{number_2_format($retirement->other_cost)}}</td>
                                    {{-- Other Cost attachment--}}
                                    @if($retirement->getFirstMediaUrl('othercost_attachments'))
                                        <td><a href="{{$retirement->getFirstMediaUrl('othercost_attachments')}}" class="btn btn-outline-info btn-sm mb-1" target="_blank">View attachment</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>Total Amount Spent</b></td>
                                    <td><b>{{number_2_format($retirement->total_amount)}}</b></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>Total Amount Paid</b></td>
                                    <td><b>{{number_2_format($retirement->total_amount_paid)}}</b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>Balance</b></td>
                                    <td><b>{{number_2_format($retirement->balance)}}</b></td>
                                    {{-- Balance/Receipt attachment--}}
                                    @if($retirement->getFirstMediaUrl('receipt_attachment'))
                                        <td><a href="{{$retirement->getFirstMediaUrl('receipt_attachment')}}" class="btn btn-outline-info btn-sm mb-1" target="_blank">View attachment</a></td>
                                    @else
                                        <td></td>
                                    @endif
                                </tr>

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


        </div>
    </div>

@endsection
