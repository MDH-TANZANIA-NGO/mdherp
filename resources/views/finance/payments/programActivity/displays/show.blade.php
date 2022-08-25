@extends('layouts.app')
@section('content')
    @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="tags">

                        <div class="tag">
                            Requisition
                            <a href="{{route('requisition.show', $requisition->uuid)}}" class="tag-addon">{{$requisition->number}}</a>
                        </div>
                        <div class="tag">
                            Activity
                            <a href="{{route('programactivity.show', $program_activity->uuid)}}" class="tag-addon">{{$program_activity->number}}</a>
                        </div>
                        <div class="tag">
                            Activity Report
                            <a href="{{route('activity_report.show', $activity_report->uuid)}}" class="tag-addon">{{$activity_report->number}}</a>
                        </div>
                    </div>
{{--                    <a href="{{route('requisition.show', $requisition->uuid)}}"><h3 class="card-title">{{$requisition->number}}</h3></a>--}}
                </div>
                <div class="card-body">
{{--                    <div class="">--}}

{{--                        <a href="{{route('programactivityreport.show', $program_activity->programActivityReport->where('id', $payment->activityPayment->program_activity_report_id)->first()->uuid)}}"><h4 class="mb-1"><strong>{{$program_activity->programActivityReport->where('id', $payment->activityPayment->program_activity_report_id)->first()->number}}</strong></h4></a>--}}
{{--                        Has been initiated Total Payment of<strong>{{number_2_format($payment->payed_amount)}}</strong> (TZS)--}}
{{--                    </div>--}}

{{--                    <div class="card-body pl-0 pr-0">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-sm-6">--}}
{{--                                <span>Activity No.</span><br>--}}
{{--                                <a href="{{route('programactivity.show',$program_activity->uuid)}}" ><strong>{{$program_activity->number}}</strong></a><br>--}}
{{--                            </div>--}}
{{--                            <div class="col-sm-6 text-right">--}}
{{--                                <span>Requested Date</span><br>--}}
{{--                                <strong>{{date('d-M-Y', strtotime($program_activity->created_at))}}</strong>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="dropdown-divider"></div>--}}
                    <div class="row pt-4">
                        <div class="col-lg-6 ">
                            <p class="h3">Activity Info</p>
                            <address>
                                Activity Location: {{$program_activity->training->district->name}}<br>
                                Start Date: {{date('d-M-Y', strtotime($program_activity->training->start_date))}}<br>
                                End Date: {{date('d-M-Y', strtotime($program_activity->training->end_date))}}<br>

                            </address>
                        </div>
                        <div class="col-lg-6 text-right">
                            <p class="h3">Activity Coodinator</p>
                            <address>
                                {{$program_activity->user->first_name}} {{$program_activity->user->last_name}}<br>
                                {{$program_activity->user->designation->unit->name}} {{$program_activity->user->designation->name}}<br>
                                {{$program_activity->user->phone}}<br>
                                {{$program_activity->user->email}}
                            </address>
                        </div>
                    </div>
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <tr class=" ">
                                <th class="text-center " style="width: 1%"></th>
                                <th>Activity Costs</th>
                                <th class="text-right" style="width: 20%">Amount</th>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <p class="font-w600 mb-1">Participants Cost</p>
                                </td>

                                <td class="text-right">{{number_2_format($payment->activityPayment->total_participant_amount_paid)}}</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <p class="font-w600 mb-1">Items Cost</p>
                                </td>
                                <td class="text-right">{{number_2_format($payment->activityPayment->total_items_amount_paid)}}</td>
                            </tr>


                            <tr>
                                <td colspan="2" class="font-w600 text-right">Total Amount Requested</td>
                                <td class="font-weight-bold text-right">{{number_2_format($requisition->amount)}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="font-w600 text-right">Total Amount Paid</td>
                                <td class="font-weight-bold text-right">{{number_2_format($payment->payed_amount)}}</td>
                            </tr>

                            <tr>
                                <td colspan="3" class="text-right">
{{--                                    @if($payment->user->id == access()->user()->id)--}}

{{--                                    <a href="{{route('programactivityreport.show',  $program_activity_report->uuid)}}" class="btn btn-primary" ><i class="si si-wallet"></i> Edit Payment</a>--}}
{{--                                    @endif--}}
                                    <button type="button" class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i> Print</button>
                                </td>
                            </tr>
                            {{--  @if($payment->wf_done == false && $payment->user_id == access()->user()->id)
                                  <tr>
                                      <td colspan="5" class="text-right">
                                          <a href="#" class="btn btn-secondary"><i class="fa fa-edit"></i> Edit</a>

                                      </td>
                                  </tr>
                              @endif--}}
                        </table>
                    </div>
                    {{--                    <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
