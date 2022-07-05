@extends('layouts.app2')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Job Offer Details</h3>
                    <div class="card-options">
                        <a href="{{route('job_offer.print', $job_offer->uuid)}}" class="btn btn-primary btn-sm float-right"><i class="fa fa-print"></i> Print</a>
                        @if($job_offer->status == null)
                            <a href="{{route('job_offer.edit', $job_offer->uuid)}}" class="btn btn-success btn-sm" style="margin-left: 2%"><i class="fa fa-check-circle"></i> Accept</a>
                            <a href="{{route('job_offer.edit', $job_offer->uuid)}}" class="btn btn-instagram btn-sm" style="margin-left: 2%"><i class="fa fa-ban"></i> Reject</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <h4 class="mb-1"><strong>Congratulation! {{$job_offer->interviewApplicant->applicant->full_name}},</strong>,</h4>
                        has been given offer of <strong>${{currency_converter($job_offer->salary, 'TSH')}}</strong> (USD) for job position as <b>{{strtoupper($job_offer->interviewApplicant->interviews->jobRequisition->designation->full_title)}}</b>
                    </div>

                    <div class="card-body pl-0 pr-0">
                        <div class="row">
                            <div class="col-sm-6">
                                <span>Job offer No.</span><br>
                                <strong>{{$job_offer->number}}</strong>
                            </div>
                            <div class="col-sm-6 text-right">
                                <span>Expected arrival date</span><br>
                                <strong>{{$job_offer->date_of_arrival}}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Other benefits</h3>
{{--                                                            <div class="card-options">--}}
{{--                                                                <a href="#" class="btn btn-primary btn-sm">Accept</a>--}}
{{--                                                                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>--}}
{{--                                                                <a href="#" class="btn btn-primary btn-sm">Decline</a>--}}
{{--                                                            </div>--}}
                                                        </div>
                            <div class="card-body">
                                {!! htmlspecialchars_decode($job_offer->details) !!}
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="table-responsive push">--}}
                    {{--                        <table class="table table-bordered table-hover">--}}
                    {{--                            <tbody><tr class=" ">--}}
                    {{--                                <th>Other Benefits</th>--}}
                    {{--                            </tr>--}}
                    {{--                            <tr>--}}
                    {{--                                <td>--}}
                    {{--                                    <p class="font-w600 mb-1">{!! htmlspecialchars_decode($job_offer->details) !!}</p>--}}
                    {{--                                </td>--}}

                    {{--                            </tr>--}}

                    {{--                            <tr>--}}
                    {{--                                <td colspan="1" class="font-weight-bold text-uppercase text-right">Working station : Tabora</td>--}}
                    {{--                            </tr>--}}
                    {{--                            <tr>--}}
                    {{--                                <td colspan="1" class="text-right">--}}
                    {{--                                    <a href="{{route('job_offer.edit', $job_offer->uuid)}}" type="button" class="btn btn-secondary" ><i class="si si-paper-plane"></i> Edit</a>--}}
                    {{--                                    <a href="{{route('job_offer.print', $job_offer->uuid)}}" class="btn btn-info" ><i class="si si-printer"></i> Print Offer</a>--}}
                    {{--                                </td>--}}
                    {{--                            </tr>--}}
                    {{--                            </tbody></table>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
