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
            <h3 class="card-title">Fleet Summary</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                {{-- <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Program</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Starting time</th>
                            <th>Ending time</th>
                        </tr>
                    </thead>
                    <tbody>


                        <tr>
                            <td>{{$fleetrequest->date}}</td>
                            <td>{{$fleetrequest->program}}</td>
                            <td>{{$fleetrequest->activity_description}}</td>
                            <td>{{$fleetrequest->location}}</td>
                            <td>{{$fleetrequest->starting_time}}</td>
                            <td>{{$fleetrequest->ending_time}}</td>

                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->

        </div>

    </div>
</div>
@endsection