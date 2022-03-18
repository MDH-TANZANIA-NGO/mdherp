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
                <h3 class="card-title">Timesheet Summary</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>
                            <th> # </th>
                            <th>Total Hours</th>
                            <th>Submitted Date</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{$timesheet->id}}</td>
                                <td>{{$timesheet->hrs}}</td>
                                <td>{{ \Carbon\Carbon::parse($timesheet->created_at)->format('d/m/Y')}}</td>
                                <td>{{$timesheet->user->identity_number}}</td>
                                <td>{{$timesheet->user->full_name_formatted}}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->

            </div>

        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hour Distribution Based on LOE</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>
                            <th>Project</th>
                            <th>Hours</th>
                            <th>Percentage</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($time_percentages as $time_percentage)
                            <tr>
                                <td>{{$time_percentage['project']}}</td>
                                <td>{{$time_percentage['percentage']}}</td>
                                <td>{{$time_percentage['percent']}} %</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hourly Description on Daily Base </h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>
                            <th>Date</th>
                            <th>Comment</th>
                            <th>Hours</th>
                            @foreach($time_percentages as $time_percentage)
                                <th>{{$time_percentage['project']}}</th>
                            @endforeach


                        </tr>
                        </thead>
                        <tbody>

                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{\Carbon\Carbon::parse($attendance['date'])->format('d/m/Y')}}</td>
                                <td>{{$attendance['comments']}}</td>
                                <td>{{$attendance['hours']}}</td>
                                @foreach($attendance['percentage'] as $percent)
                                    <td>{{$percent['daily_percent']}}</td>
                                @endforeach
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
