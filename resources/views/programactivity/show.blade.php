@extends('layouts.app')
@section('content')
    @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])



    <br>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Activity Summary</h3>
                    <a href="{{route('requisition.show', $requisition_uuid)}}" class="btn btn-sm btn-info float-right" style="margin-left: 70%"><i class="fa fa-info-circle"></i>
                        {{$requisition->number }}
                    </a>
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="tags">

                        <div class="tag tag-primary">
                            {{$activity_location}}
                            <span class="tag-addon"><i class="fe fe-map-pin"></i></span>
                        </div>

                        <div class="tag">
                            start date
                            <span class="tag-addon tag-success">{{date('d-M-Y', strtotime($activity_details->start_date) )}}</span>
                        </div>
                        <div class="tag">
                            end date
                            <span class="tag-addon tag-success">{{date('d-M-Y', strtotime($activity_details->end_date))}}</span>
                        </div>
                        <span class="tag tag-default">
														Total Participants
														<span class="tag-addon tag-warning">{{$activity_participants_count}}</span>
													</span>
                        <span class="tag tag-default">
														Total Items
														<span class="tag-addon tag-warning">{{$training_items_count}}</span>
													</span>
                    </div>

                    <br>
                    <h3 class="card-title">Participants List</h3>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead >
                            <tr>

                                <th >Full Name</th>
                                <th >Phone</th>
                                <th >Perdiem</th>
                                <th >Transportation</th>
                                <th>Other Cost</th>
                                <th >Total</th>
                                @if(access()->user()->id == $supervisor && $program_activity->wf_done == true)
                                    <th>Status</th>
                                @else
                                    @if($program_activity->wf_done == true)
                                        <th >Action</th>
                                    @endif
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
                                            @if(access()->user()->id == $supervisor )

                                                @if($participants->is_substitute == true)
                                                    <span class="tag tag-yellow">Substituted</span>
                                                @endif
                                                @if($participants->attend == true)
                                                    <span class="tag tag-green">Attended</span>
                                                @endif
                                                @if($participants->attend == false)
                                                    <span class="tag tag-gray">Not Attended</span>
                                                @endif
                                            @else
                                                @if($participants->is_substitute == false)

                                                    <a href="{{ route('programactivity.editParticipant',$participants->uuid) }}"  class="btn btn-warning" >Swap</a>
                                                @endif
                                                @if($participants->attend == false)
                                                    <a href="{{ route('programactivity.programActivityAttendance',$participants->uuid) }}" id="attendance" class="btn btn-cyan" onclick="confirm('Are you Sure, He/She Attended? ')" >Attended</a>
                                                @endif
                                                @if($participants->is_substitute ==  true || $participants->attend == true)
                                                    <a href="{{ route('programactivity.undoEverything',$participants->uuid) }}" id="attendance" class="btn btn-info" onclick="confirm('Are you Sure You want to Undo all Changes?')" >Undo</a>
                                                @endif
                                            @endif
                                        </td>
                                    @endif


                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive -->
                    <br>
                    <h3 class="card-title">Items Requested</h3>
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
                            @if(count($training_items) > 0)
                                    @foreach($training_items as $items)
                                        <tr>

                                            <td>{{$items->title}}</td>
                                            <td>{{$items->unit}}</td>
                                            <td>{{$items->unit_price}}</td>
                                            <td>{{$items->total_amount}}</td>
                                        </tr>
                                        <td>{{$items->title}}</td>
                                        <td>{{$items->unit}}</td>
                                        <td>{{$items->unit_price}}</td>
                                        <td>{{$items->total_amount}}</td>
                                        </tr>

                                    @endforeach
                            @else
                                <tr><td colspan="5" style="text-align: center">No Item Requested</td></tr>
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <!-- table-responsive -->
                </div>
                <br>



                </div>
            </div>
        </div>
    @endsection
