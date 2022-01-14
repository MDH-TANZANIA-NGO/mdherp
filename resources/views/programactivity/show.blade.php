@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                {{--            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Pay</button>--}}
                <a href=" {{route('requisition.show', $requisition_uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">View Approved Requisition</a>

                @if($program_activity->wf_done == true)
                <a href=" {{route('programactivity.report', $program_activity->uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">Submit Report</a>
                    @endif
            </div>

        </div>
    </div>

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
                            <th>End Date</th>

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
                            @if($program_activity->wf_done == true)
                            <th >Action</th>
                                @endif

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
                                @if($program_activity->wf_done == true)
                                <td>
                                    @if($participants->is_substitute == false)

                                    <a href="{{ route('programactivity.editParticipant',$participants->uuid) }}"  class="btn btn-warning" ><i class="fa fa-rotate-left"></i></a>
                                    @endif
                                    @if($participants->attend == false)
                                    <a href="{{ route('programactivity.programActivityAttendance',$participants->uuid) }}" id="attendance" class="btn btn-cyan" onclick="confirm('Are you Sure?')" >Attended</a></td>
                                    @endif
                                        @if($participants->is_substitute ==  true || $participants->attend == true)
                                    <a href="{{ route('programactivity.undoEverything',$participants->uuid) }}" id="attendance" class="btn btn-info" onclick="confirm('Are you Sure?')" >Undo</a></td>
                                            @endif
                                @endif
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
                <h3 class="card-title">ITEMS NEEDED</h3>
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

                            <th >Item</th>
                            <th >Quantity</th>
                            <th >Unit Price</th>
                            <th >Total Price</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($training_items as $items)
                            <tr>

                                <td>{{$items->title}}</td>
                                <td>{{$items->unit}}</td>
                                <td>{{$items->unit_price}}</td>
                                <td>{{$items->total_amount}}</td>
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
