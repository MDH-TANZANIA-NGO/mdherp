@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Job Offer Details</h3>
                </div>
                <div class="card-body">
                    <div class="">
                        <h4 class="mb-1"><strong>Jessica Allen</strong>,</h4>
                        has been given offer of <strong>${{currency_converter($job_offer->salary, 'TSH')}}</strong> (USD) for job position as <b>ICT CUM Software Developer</b>
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
                    <div class="row pt-4">
                        <div class="col-lg-6 ">
                            <p class="h3">Other Benefits</p>
                            <address>
                                {!! htmlspecialchars_decode($job_offer->details) !!}
                            </address>
                        </div>

                    </div>
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <tbody><tr class=" ">
                                <th>Job Details</th>
                            </tr>
                            <tr>
                                <td>
                                    <p class="font-w600 mb-1">Job Details to be set here</p>
                                </td>

                            </tr>

                            <tr>
                                <td colspan="1" class="font-weight-bold text-uppercase text-right">Working station : Tabora</td>
                            </tr>
                            <tr>
                                <td colspan="1" class="text-right">
                                    <a href="{{route('job_offer.edit', $job_offer->uuid)}}" type="button" class="btn btn-secondary" ><i class="si si-paper-plane"></i> Edit</a>
                                    <button type="button" class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Offer</button>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
