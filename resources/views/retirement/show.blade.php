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
                <h3 class="card-title">Retirement Summary</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Activity Report</h5>
                        </div>
                        <hr>
                        <p class="mb-1">{{$retirement->details->activity_report}}</p>
                    </a>

                </div>

                <hr>


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
                <!-- table-responsive -->
            </div>
        </div>
    </div>

@endsection
