<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Participants List</h3>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    {{--                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>--}}
                </div>
            </div>
            <div class="card-body">
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

                                            @if($participants->attend == false)
                                                @if($participants->is_substitute == false)

                                                    <a href="{{ route('programactivity.editParticipant',$participants->uuid) }}" class="form-control"  ><i class=" fa fa-exchange" style="margin-left: 40%" ></i></a>
                                                @endif
                                                    {!! Form::open(['route' => ['programactivity.programActivityAttendance',$participants->uuid], 'method'=>'POST']) !!}
                                                    <input type="number" value="{{$participants->id}}" name="g_officer_id" hidden>
                                                    <input type="number" value="{{$program_activity->id}}" name="program_activity_id" hidden>

{{--                                                    <a href="{{ route('programactivity.programActivityAttendance',$participants->uuid) }}" id="attendance" class="btn btn-cyan" onclick="confirm('Are you Sure, He/She Attended? ')" >Attended</a>--}}

                                                    <button type="submit" class="form-control" ><i class="fa fa-clock-o"></i></button>

                                                    {!! Form::close() !!}
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
            </div>
        </div>
    </div>
</div>
