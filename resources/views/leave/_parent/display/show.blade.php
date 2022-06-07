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
                <h3 class="card-title">Leave Summary</h3>
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
                            <th> Type </th>
                            <th>Employee</th>
                            <th>From</th>
                            <th>To</th>
                            <th># Days</th>
                            <th>Co worker</th>
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
                            <td>{{$leave->employee->full_name_formatted}}</td>
                            <td>{{$leave->comment}}</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->

            </div>

        </div>
    </div>


@endsection
