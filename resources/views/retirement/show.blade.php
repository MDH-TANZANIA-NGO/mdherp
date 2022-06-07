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

                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><b>What was planned:</b></h5>
                            </div>

                            <p class="mb-1">{{$retirement->details->planned_report}}</p>

                            <hr>
                        <h5 class="mb-1"><b>Number of Participants: </b>{{$retirement->details->no_participants}}</h5>

                            <hr>

                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><b>Objectives:</b></h5>
                            </div>

                            <p class="mb-1">{{$retirement->details->objective_report}}</p>

                            <hr>

                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><b>Methodology:</b></h5>
                            </div>

                            <p class="mb-1">{{$retirement->details->methodology_report}}</p>

                            <hr>

                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><b>Achievements:</b></h5>
                            </div>

                            <p class="mb-1">{{$retirement->details->achievement_report}}</p>

                            <hr>

                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><b>Challenges:</b></h5>
                            </div>

                            <p class="mb-1">{{$retirement->details->challenge_report}}</p>

                            <hr>

                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><b>Recommendations/Action plans:</b></h5>
                            </div>

                            <p class="mb-1">{{$retirement->details->action_report}}</p>



                    </div>


                </div>

            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>

                            <th>Retirement Number</th>
                            <th>Destination</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Amount Paid</th>
                            <th>Amount Received</th>
                            <th>Amount Spent</th>
                            <th>Amount Variance</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($retirementz as $retirement)
                            <tr>
                                <td>{{$retirement->number}}</td>
                                <td>{{$retirement->districts->name}}</td>
                                <td>{{$retirement->from}}</td>
                                <td>{{$retirement->to}}</td>
                                <td>{{$retirement->amount_paid}}</td>
                                <td>{{$retirement->amount_received}}</td>
                                <td>{{$retirement->amount_spent}}</td>
                                <td>{{$retirement->amount_variance}}</td>

                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="table-responsive">
                    @if($retirement->getFirstMediaURL('attachments') != null)
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>

                            <th>#</th>
                            <th>Attachment Name</th>
                            <th>Attachment </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($retirementz as $retirement)
                            <tr>
                                <td>1</td>
                                <td>Attachment</td>
{{--                                <td>{{$retirement->getFirstMedia('attachments')->pluck('name')}}</td>--}}
{{--                                {{$retirement->getRegisteredMediaCollections()}}--}}
                                <td><a href="{{$retirement->getFirstMediaURL('attachments')}}" target="_blank">view</a></td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                    @else

                            <div class="col-md-12 align-content-center">
                            <label class="">No Attachment</label> 
                            </div>

                    @endif
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>

@endsection
