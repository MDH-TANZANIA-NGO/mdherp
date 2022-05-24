<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Participants List</h3>

                <div class="card-options ">
{{--                    <a href="{{route('programactivity.export', $program_activity->uuid)}}"  class="btn btn-outline-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>--}}
       </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {!! Form::open(['route' => ['programactivity.programActivityAttendance',$program_activity->uuid ], 'method'=>'POST']) !!}
                    @if($program_activity->user_id == access()->user()->id)
                    <button type="submit" class="btn btn-outline-info " data-toggle="modal" data-target="#exampleModal">Capture Attendance</button>
                    @endif
<br>
                    <br>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead >
                        <tr>
                            <th><input type="checkbox" class="selectall"></th>
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
                                    <td><input type="checkbox" name="ids[]" class="selectbox" value="{{$participants->id}}"></td>

                                    {!! Form::close() !!}
                                    <td>  {{$participants->user->first_name}} {{$participants->user->last_name}}</td>
                                    <td>{{$participants->user->phone}}</td>
                                    <td>{{$participants->programActivityAttendance->count()}}/ {{$activity_details->no_days}}</td>
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
                                        <a href="{{route('programactivity.viewParticipantAttendance', $participants->id)}}" class="btn btn-primary">View Attendance</a>

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

@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#example").dataTable()
        })

        $('.selectall').click(function (){
            $('.selectbox').prop('checked', $(this).prop('checked'));
        })
        $('.selectbox').change(function (){
            var total =  $('.selectbox').length;
            var number = $('.selectbox:checked').length();
            if (total == number){
                $('.selectall').prop('checked', true);
                $('#next-container').toggle(number);
            }else {
                $('.selectall').prop('checked', false);
            }

        })
    </script>



@endpush


