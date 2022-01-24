@extends('layouts.app')
@section('content')
    @if($program_activity->report != null && $program_activity->done == 0 && access()->user()->id != $supervisor)
        {!! Form::open(['route' => ['programactivity.submit',$program_activity->uuid]]) !!}
        <button type="submit" class="btn btn-success" style="margin-left: 45%; margin-bottom: 1%">Submit For Approval <i class="fa fa-check fa-spin ml-2"></i></button>
{{--        <a href=" {{route('programactivity.submit', $program_activity->uuid)}}" class="btn btn-success" style="margin-left: 45%; margin-bottom: 1%">Submit For Approval <i class="fa fa-check fa-spin ml-2"></i></a>--}}
            {!! Form::close() !!}
    @endif
    <div class="row">
        <div class="card">
            <div class="card-header">
                {{--            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModal3">Pay</button>--}}
                <a href=" {{route('requisition.show', $requisition_uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">View Approved Requisition</a>
                @if($program_activity->done == 1)
                    <button class="btn btn-outline-info" data-toggle="modal" data-target="#largeModal"style="margin-left: 2%;">View Activity Workflow</button>

                    <!-- Large Modal -->
                    <div id="largeModal" class="modal fade">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content ">
                                <div class="modal-header pd-x-20">
                                    <h6 class="modal-title">Activity Workflow</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
                                    </div>
                                </div>
                            </div>
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->

                @endif
                @if(access()->user()->id == $supervisor && $program_activity->done == 1)

                    <button class="btn btn-outline-info" data-toggle="modal" data-target="#smallModal"style="margin-left: 2%;">Approve Activity Report</button>

                    <!-- Large Modal -->
                    <div id="smallModal" class="modal fade">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content ">
                                <div class="modal-header pd-x-20">
                                    <h6 class="modal-title">Action</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body pd-20">
                                    {!! Form::open(['route' => ['programactivity.approveReport',$program_activity->uuid]]) !!}
                                    <label>Action</label>
                                    <select name="approval" class="form-control">
                                        <option value="true">Approve</option>
                                        <option value="false">Reject</option>

                                    </select>
                                    <br>

                                    <label>comment</label>
                                    {!! Form::textarea('remarks',null, ['class'=>'form-control']) !!}



                                </div><!-- modal-body -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->

                @endif

                  @if(access()->user()->id != $supervisor && $program_activity->done == 0 )
                @if($program_activity->wf_done == true)

                <a href=" {{route('programactivity.report', $program_activity->uuid)}}" class="btn btn-outline-info" style="margin-left: 2%;">@if($program_activity->report == null )
                        Submit Report
                    @else
                    Edit Report
                    @endif

                            @endif

                </a>
                    @endif

            </div>

        </div>
    </div>
@if($program_activity->done == 0)
    <!-- start: page -->
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>




@endif


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

  @if($program_activity->report != null)
      <div class="row">
          <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Report</h3>
                  <div class="card-options "><b>Status: </b>
                      @if( $program_activity->report_approved == true)
                            Approved
                      @elseif($program_activity->report_approved == false)
                          Not Approved
                      @endif
                      <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>

                  </div>
              </div>
              <div class="card-body">

                  {!!html_entity_decode($program_activity->report)!!}


              </div>


          </div>
      </div>
  @endif

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
                            @if(access()->user()->id == $supervisor)
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
                                        <a href="{{ route('programactivity.pay',$participants->uuid) }}" class="btn btn-success"  >Pay</a>
                                        <a href="{{ route('programactivity.pay',$participants->uuid) }}" class="btn btn-outline-primary"  >Check</a>

                                    @endif
                                            </td>
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
                        @if(count($training_items) > 0)
                        @foreach($training_items as $items)
                            <tr>

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
        </div>
    </div>






@endsection
{{--<script type="text/javascript">--}}
{{--    $(document).ready(function () {--}}
{{--        $("#btn").click(function () {--}}
{{--            $("#Create").toggle();--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}
