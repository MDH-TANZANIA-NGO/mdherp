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
                <div class="list-group">

                </div>


                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap">
                        <thead >
                        <tr>

                            <th> # </th>
{{--                            <th>Month</th>--}}
                            <th>Total Hours</th>
                            <th>Submitted Date</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{$timesheet->id}}</td>
{{--                                <td>{{$timesheet}}</td>--}}
                                <td>{{$timesheet->hrs}}</td>
                                <td>{{$timesheet->created_at}}</td>
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

@endsection