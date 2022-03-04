
@extends('layouts.app')

@section('content')
    <!-- start: page -->
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>

    @include('programactivity.display.generalSumarry')



    <div class="col-md-12">
        <div class="card card-collapsed">
            <div class="card-header">
                <h3 class="card-title">Submitted Reports List</h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead >
                        <tr>

                            <th >Report Number</th>
                            <th >Status</th>
                            <th >Submission Date</th>
                            <th>Action</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($program_activity_reports AS $reports)
                            <tr>
                                <td>{{$reports->number}}</td>
                                <td>
                                    @if($reports->wf_done == false)
                                        <span class="text-warning">On Process</span>
                                    @else
                                        <span class="text-success">Approved</span>

                                    @endif
                                </td>
                                <td>{{$reports->created_at}}</td>
                                <td><a href="{{route('programactivityreport.show',$reports->uuid)}}"><i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                </div>
        </div>
    </div>



    <div class="col-md-12  col-xl-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Activity Report Details</h3>
                <div class="card-options">


                    <a href="#" class="btn-sm">
                        <div class="tag">
                            Report Number
                            <span class="tag-addon tag-success">{{$program_activity_report->number}}</span>
                        </div>
                    </a>
                    <a href="{{route('programactivity.show',$program_activity_report->programActivity->uuid)}}" class="btn-sm ml-2">
                        <div class="tag">
                            Activity Number
                            <span class="tag-addon tag-success">{{$program_activity_report->programActivity->number}}</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <b>Venue Name</b>
                <p>{{$program_activity_report->venue_name}}</p>

                <br>
                <b>Background Info</b>
                <p>{{$program_activity_report->background_info}}</p>

                <br>
                <b>What was Planned</b>
                <p>{{$program_activity_report->what_was_planned}}</p>

                <br>
                <b>Objectives</b>
                <p>{{$program_activity_report->objectives}}</p>

                <br>
                <b>Methodology</b>
                <p>{{$program_activity_report->methodology}}</p>

                <br>
                <b>Achievement</b>
                <p>{{$program_activity_report->achievement}}</p>

                <br>
                <b>Challenges</b>
                <p>{{$program_activity_report->challenges}}</p>

                <br>
                <b>Recommendations</b>
                <p>{{$program_activity_report->recommendations}}</p>


            </div>
        </div>
    </div>
@endsection


