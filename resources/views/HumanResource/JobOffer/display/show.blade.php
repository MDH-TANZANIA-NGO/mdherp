@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>
    @if($job_offer->status == 2)
    <ul class="demo-accordion accordionjs m-0" data-active-index="false">

        <!-- Section 1 -->
        <li class="acc_section">
            <div class="acc_head"><h3>Rejected Feedback</h3></div>
            <div class="acc_content" style="display: none;"><div class="list-group">
                    @foreach($job_offer_remarks as $remarks)
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                        <div class="d-flex w-100 justify-content-between">

                            @if($remarks->applicant_id != null)
                            <h5 class="mb-1">{{$remarks->jobOfferApplicant->full_name}}</h5>
                            @elseif($remarks->user_id != null)
                                <h5 class="mb-1">{{$remarks->user->full_name}}</h5>
                            @endif
                            <small>{{getNoDays($remarks->created_at, today())-1}} days ago</small>
                        </div>
                        <p class="mb-1">{{$remarks->comments}}</p>
                    </a>
                    @endforeach
                </div>
                <br>
                <button class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-reply"></i> Reply</button>
            </div>

        </li>

    </ul>

    @endif
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
                    {!! Form::open(['route' => ['job_offer.replyRemarks',$job_offer->uuid], 'method'=>'PUT']) !!}
                    <div class="form-group">
                        <label class="form-label">Comments</label>
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


    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Job Offer Details</h3>
                    <div class="card-options">
                        <a href="{{route('job_offer.print', $job_offer->uuid)}}" class="btn btn-primary btn-sm float-right"><i class="fa fa-print"></i> Print</a>
                        @if($job_offer->user_id == access()->user()->id)
                            <a href="{{route('job_offer.edit', $job_offer->uuid)}}" class="btn btn-instagram btn-sm" style="margin-left: 2%">Edit</a>
                            @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <h4 class="mb-1"><strong>{{$job_offer->interviewApplicant->applicant->full_name}}</strong>,</h4>
                        has been given offer of <strong>${{currency_converter($job_offer->salary, 'TSH')}}</strong> (USD) for job position as <b></b>
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
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">more details</h3>--}}
{{--                                <div class="card-options">--}}
{{--                                    <a href="#" class="btn btn-primary btn-sm">Print</a>--}}
{{--                                    <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>--}}
{{--                                    <a href="#" class="btn btn-primary btn-sm">Print</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
