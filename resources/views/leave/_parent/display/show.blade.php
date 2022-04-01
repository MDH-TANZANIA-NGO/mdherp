@extends('layouts.app')
@section('content')

    <!-- start: page -->
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>

  {{--  <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Leave Summary</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    --}}{{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}{{--
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>
                            <th> Type </th>
                            <th>Requester</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Requested Days</th>
                            <th>Remaining Days</th>
                            <th>Delegated To</th>
                            <th>Comment</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>{{$type->name}}</td>
                            <td>{{$leave->user->full_name_formatted}}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d/m/Y')}}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d/m/Y')}}</td>
                            <td>{{$days}}</td>
                            <td>{{$remaining_days}}</td>
                            <td>{{$leave->employee->last_name}} {{$leave->employee->first_name}}</td>
                            <td>{{$leave->comment}}</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->

            </div>

        </div>
    </div>--}}
<div class="row">
    <div class="col-xl-12 col-md-12 col-lg-12">
    <div class="card">
        <div class="card-body">
            <p class=" mb-0 ">This leave is requested by</p>
            <h2 class="mb-0">{{$leave->user->full_name_formatted}}</h2>
            <div class="row mt-3">
                <div class="col-3 border-right">
                    <p class="mb-0 text-muted">Start date</p>
                    <h5 class="mb-0">{{ \Carbon\Carbon::parse($leave->start_date)->format('D d-M-Y')}}</h5>
                </div>
                <div class="col-3 border-right">
                    <p class="mb-0 text-muted">End date</p>
                    <h5 class="mb-0">{{ \Carbon\Carbon::parse($leave->end_date)->format('D d-M-Y')}}</h5>
                </div>

                <div class="col-3 border-right ">
                    <p class="mb-0 text-muted">Days Requested</p>
                    <h5 class="mb-0">{{$days}}</h5>
                </div>
                <div class="col-3">
                    <p class="mb-0 text-muted">Delegated to</p>
                    <h5 class="mb-0">{{$leave->employee->last_name}} {{$leave->employee->first_name}}</h5>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
    <div class="row">
        <div class="col-xl-6 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Comments</h3>
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
{{--                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                    </div>
                </div>
                <div>
                    <p style="text-align: justify; margin-left: 7%; margin-top: 3%">{{$leave->comment}}</p>
                </div>
            </div>
        </div>

        @if($remaining_days >= 5)
        <div class="col-xl-6 col-md-12 col-lg-12">
            <div class="card bg-gradient-info">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white ">
                            <h2 class="mb-1">{{$remaining_days}} Days</h2>
                            <p class=" mb-0 op1">Remaining on {{$type->name}}</p>
                        </div>
                        <div class="text-white ml-auto">
                            <i class="fe fe-clock fs-50 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @elseif($remaining_days <5 && $remaining_days > 0)
            <div class="col-xl-6 col-md-12 col-lg-12">
                <div class="card bg-gradient-warning">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white ">
                                <h2 class="mb-1">{{$remaining_days}} Days</h2>
                                <p class=" mb-0 op1">Remaining on {{$type->name}}</p>
                            </div>
                            <div class="text-white ml-auto">
                                <i class="fe fe-clock fs-50 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @elseif($remaining_days == 0)
            <div class="col-xl-6 col-md-12 col-lg-12">
                <div class="card bg-gradient-danger">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="text-white ">
                                <h2 class="mb-1">{{$remaining_days}} Days</h2>
                                <p class=" mb-0 op1">Remaining on {{$type->name}}</p>
                            </div>
                            <div class="text-white ml-auto">
                                <i class="fe fe-clock fs-50 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif


@endsection
