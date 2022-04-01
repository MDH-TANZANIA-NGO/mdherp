<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Participants List</h3>

                <div class="card-options ">
                    <a href="{{route('programactivity.export', $program_activity->uuid)}}"  class="btn btn-outline-success"><i class="fa fa-file-excel-o"></i></a>
                    @permission('finance_activity')
                    <a href="#"  class="btn btn-outline-primary" style="margin-left: 7%"><i class="fa fa-check"></i></a>
                    @endpermission


{{--                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>--}}
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead >
                        <tr>
                            <th >Name</th>
                            <th >Phone</th>
                            <th>Days</th>
                            <th >Perdiem</th>
                            <th >Transportation</th>
                            <th>Other Cost</th>
                            <th >Total</th>
                            <th >Paid</th>
                            @if((access()->user()->id != $program_activity->user_id ||access()->user()->id == $supervisor ) && $program_activity->wf_done == 1)
                                <th>Status</th>
                                <th >Action</th>
                            @else
                                @if($program_activity->wf_done == 1)
                                    <th >Swap</th>
                                    <th >Attendance</th>

                                @endif
                            @endif

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($activity_participants as $participants)
                            <a href="#">

                                <tr>

                                    <td>{{$participants->user->first_name}} {{$participants->user->last_name}}</td>
                                    <td>{{$participants->user->phone}}</td>
                                    <td>{{$attendance->where('g_officer_id', $participants->participant_uid)->count()}}/ {{$activity_details->no_days}}</td>
                                    <td>{{number_2_format($participants->perdiem_total_amount)}}</td>
                                    <td>{{number_2_format($participants->transportation)}}</td>
                                    <td>{{number_2_format($participants->other_cost)}} <span class="text-default">{{$participants->others_description}}</span></td>
                                    <td>{{number_2_format($participants->total_amount)}}</td>
                                    <td>{{number_2_format($participants->amount_paid)}}</td>
                                    @if($program_activity->wf_done == 1)
                                        <td>
                                            @if(access()->user()->id == $supervisor || access()->user()->id != $program_activity->user_id )

                                                @if($participants->is_substitute == true)
                                                    <span class="tag tag-yellow">Substituted</span>
                                                @endif

                                            @else
                                                @if($participants->attend == false)
                                                    @if($participants->is_substitute == false)

                                                        <a href="{{ route('programactivity.editParticipant',$participants->uuid) }}" class="btn btn-primary"  ><i class=" fa fa-exchange"  ></i></a>
                                                    @endif

                                                @endif
                                                @if($participants->is_substitute ==  true || $participants->attend == true)

                                                    <a href="{{ route('programactivity.undoEverything',$participants->uuid) }}" id="attendance" class="btn btn-info" onclick="confirm('Are you Sure You want to Undo all Changes?')" >Undo</a>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row">
                                                @if(access()->user()->id == $supervisor || access()->user()->id != $program_activity->user_id )

                                                    {!! Form::open(['route' => ['programactivity.viewParticipantAttendance',$participants->participant_uid], 'method'=>'POST']) !!}

                                                    <input type="number" name="program_activity_id" value="{{$program_activity->id}}" hidden>
                                                    <button type="submit" class="btn btn-primary" style="margin-left: 10%" ><i class="fa fa-eye"></i></button>
                                                    {{--                                                <a href="{{route('programactivity.viewParticipantAttendance', $participants->participant_uid)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>--}}
                                                    {!! Form::close() !!}
                                                    @permission('finance_activity')


                                                    <a href="{{route('programactivity.pay', $participants->uuid)}}"  class="btn btn-outline-primary" style="margin-left: 7%" ><i class="fa fa-check"></i></a>


                                                    <!-- Modal -->
                                                    <div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg " role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="largemodal1">Verify and Pay : {{$participants->user->first_name}} {{$participants->user->last_name}} {{$participants->user->phone}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                   Enter Total Amount you need to pay
                                                                    {!! Form::open(['route' => ['programactivity.viewParticipantAttendance',$participants->participant_uid], 'method'=>'POST']) !!}
                                                                    <input type="number" name="program_activity_id" value="{{$program_activity->id}}" hidden>
                                                                    <input type="number" name="amount_paid" value="{{$participants->total_amount}}" class="form-control">
                                                                    <input type="number" name="g_officer_id" value="{{$participants->user->id}}" hidden>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endpermission
                                                @else


                                                    {!! Form::open(['route' => ['programactivity.programActivityAttendance',$participants->uuid], 'method'=>'POST']) !!}
                                                    <input type="number" value="{{$participants->participant_uid}}" name="g_officer_id" hidden>
                                                    <input type="number" value="{{$program_activity->id}}" name="program_activity_id" hidden>

                                                    <button type="submit" class="btn btn-primary" style="margin-left: 7%" ><i class="fa fa-clock-o"></i></button>






                                                    {!! Form::close() !!}
                                                    {!! Form::open(['route' => ['programactivity.viewParticipantAttendance',$participants->participant_uid], 'method'=>'POST']) !!}

                                                    <input type="number" name="program_activity_id" value="{{$program_activity->id}}" hidden>
                                                    <button type="submit" class="btn btn-primary" style="margin-left: 10%" ><i class="fa fa-eye"></i></button>
                                                    {{--                                                <a href="{{route('programactivity.viewParticipantAttendance', $participants->participant_uid)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>--}}
                                                    {!! Form::close() !!}
                                                @endif

                                            </div>

                                        </td>


                                        @endif



                                </tr>
                            </a>


                        @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- table-responsive -->
            </div>
        </div>
    </div>
</div>


