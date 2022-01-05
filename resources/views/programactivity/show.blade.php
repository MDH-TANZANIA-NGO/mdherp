@extends('layouts.app')
@section('content')



    <!-- start: page -->
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>


{{--    @if($unit->unit_id == 24 || $unit->unit_id == 23)--}}
{{--        @if($program_activity->wf_done == true)--}}
{{--            @if($program_activity->amount_paid < $program_activity->amount_requested)--}}
{{--                <div class="row">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-header">--}}
{{--                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Pay</button>--}}
{{--                            <a href="{{route('requisition.show', $program_activity->training->trainingCost->requisition->uuid)}}" class="btn btn-outline-info" style="margin-left: 4%;">View Approved Requisition</a>--}}

{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @else--}}
{{--            <div class="row">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        --}}{{--            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Pay</button>--}}
{{--                        <a href=" {{route('requisition.show', $program_activity->training->trainingCost->requisition->uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">View Approved Requisition</a>--}}

{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @elseif($unit->unit_id != 24 || $unit->unit_id != 23)--}}
{{--        <div class="row">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    --}}{{--            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Pay</button>--}}
{{--                    <a href=" {{route('requisition.show', $program_activity->training->trainingCost->requisition->uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">View Approved Requisition</a>--}}

{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}

{{--    @endif--}}


    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ACTIVITY SUMMARY</h3>
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

                            <th>Location</th>
                            <th>Start Date</th>
                            <th>Eend Date</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activity_details as $details)
                            <tr>

                                <td>{{$details->district->name}}</td>
                                <td>{{$details->from}}</td>
                                <td>{{$details->to}}</td>

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
                <h3 class="card-title">PARTICIPANTS DETAILS</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead >
                        <tr>

                            <th >Full Name</th>
                            <th >Phone</th>
                            <th >Perdiem</th>
                            <th >Transportation</th>
                            <th>Other Cost</th>
                            <th >Total</th>
                            <th >Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activity_participants as $participants)
                            <tr>

                                <td>{{$participants->user->first_name}} {{$participants->user->last_name}}</td>
                                <td>{{$participants->user->phone}}</td>
                                <td>{{$participants->perdiem_total_amount}}</td>
                                <td>{{$participants->transportation}}</td>
                                <td>{{$participants->other_cost}}</td>
                                <td>{{$participants->total_amount}}</td>
                                <td><a href="{{ route('programactivity.editParticipant',$participants->uuid) }}"  class="btn btn-warning" ><i class="fa fa-rotate-left"></i></a> <a href="" id="attendance" class="btn btn-cyan" data-toggle="modal" data-target="#exampleModal" data-id="{{$participants->participant_uid}}"><i class="fa fa-clock-o"></i></a></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mark Attendance</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="margin-left: 25%;">
                    <button type="button" class="btn btn-outline-success">Attended</button>
                    <button type="button" class="btn btn-outline-warning" style="margin-left: 4%">Not Attended</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Swap Participant With</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" >
                    {!! Form::select('gOfficer_id',$gofficers, null, ['class' => 'form-control select2-show-search', 'required','style'=>'width:100%']) !!}
                    {!! $errors->first('gOfficer_id', '<span class="badge badge-danger">:message</span>') !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->

@endsection
