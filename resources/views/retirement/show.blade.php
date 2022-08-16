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
            <div class="card-body">




                        @foreach($retirementz as $retirement)
                        @endforeach



                <hr>

                <div class="table-responsive">
                    {{--{{$retirement->getMedia('attachments')}}
                    @foreach($retirement->getMedia('attachments') as $media)
                        <a href="{{ $media->original_url }}">{{ $media->file_name }}</a>
                    @endforeach--}}

                    @if($retirement->getMedia('attachments'))
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>

                            <th>#</th>
                            <th>Attachment Name</th>
                            <th>Attachment </th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($retirement->getMedia('attachments') as $key => $media)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $media->name }}</td>
{{--                                <td>{{$retirement->getFirstMedia('attachments')->pluck('name')}}</td>--}}
{{--                                {{$retirement->getRegisteredMediaCollections()}}--}}
                                <td><a href="{{$media->original_url}}" target="_blank">View attachment</a></td>
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
                                @foreach($retirementz as $retirementd)
                                <tr>
                                    <td><i class="fa fa-bed"></i></td>
                                    <td>Accommodation</td>
                                    <td>{{number_2_format($retirement->accomodation)}}</td>
                                    {{--  attachment--}}
                                    @if($retirement->getMedia())
                                        <td><a href="{{$retirement->getMedia()}}" target="_blank">View attachment</a></td>
                                        {{--@foreach($retirement->getMedia('attachments') as $media)
                                           <td><a href="{{$media->original_url}}" target="_blank">View attachment</a></td>
                                        @endforeach--}}
                                    @else
                                        <td>No Attachment</td>
                                    @endif

                                </tr>
                                <tr>
                                    <td><i class="fa fa-cutlery"></i></td>
                                    <td>Meals and Incidentals</td>
                                    <td>{{number_2_format($retirementd->perdiem_total_amount)}}</td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td><i class="fa fa-subway"></i></td>
                                    <td>On transit</td>
                                    <td>{{number_2_format($retirementd->ontransit)}}</td>
                                    <td>attachment</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-ticket"></i></td>
                                    <td>Ticket Fair</td>
                                    <td>{{number_2_format($retirementd->ticket_fair)}}</td>
                                    <td>attachment</td>
                                </tr>
                                <tr>
                                    <td><i class="fa fa-taxi"></i></td>
                                    <td>Ground Transportation</td>
                                    <td>{{number_2_format($retirementd->transportation)}}</td>
                                    <td>attachment</td>
                                </tr>

                                <tr>
                                    <td><i class="fa fa-exclamation"></i></td>
                                    <td>Other Cost</td>
                                    <td>{{number_2_format($retirementd->other_cost)}}</td>
                                    <td>attachment</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>Total Amount Spent</b></td>
                                    <td><b>{{number_2_format($retirementd->total_amount)}}</b></td>
                                    <td></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>Total Amount Paid</b></td>
                                    <td><b>{{number_2_format($retirementd->total_amount_paid)}}</b></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>Balance</b></td>
                                    <td><b>{{number_2_format($retirementd->balance)}}</b></td>
                                    <td>attachment</td>
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
