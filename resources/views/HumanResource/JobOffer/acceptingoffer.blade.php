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
                            <a href="{{route('job_offer.acceptingOffer', $job_offer->uuid)}}" class="btn btn-success btn-sm" style="margin-left: 2%"><i class="fa fa-check-circle"></i> Accept</a>
                            <button type="button"class="btn btn-instagram btn-sm" data-toggle="modal" data-target="#exampleModal" style="margin-left: 2%"><i class="fa fa-ban"></i> Reject</button>
                        @endif
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Job offer remarks</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::open(['route' => ['job_offer.rejectOffer',$job_offer->uuid], 'method'=>'PUT']) !!}
                                <div class="form-group">
                                    <label class="form-label">Why do you reject offer?</label>
                                    <textarea class="form-control" name="comments" rows="7" placeholder="text here.."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <h4 class="mb-1"><strong>Congratulation! {{$job_offer->interviewApplicant->applicant->full_name}},</strong>,</h4>
                        has been given offer of <strong>${{currency_converter($job_offer->salary, 'TSH')}}</strong> (USD) for job position as <b>{{strtoupper($job_offer->interviewApplicant->jobRequisition->designation->full_title)}}</b>
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
                        <p class="text-muted text-center " style="margin-left: 30%" >Thank you choosing working with us! For any inquiry please call us 0758698022</p>
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
