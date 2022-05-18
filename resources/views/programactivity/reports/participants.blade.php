<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Participants List</h3>

                <div class="card-options ">
                    <a href="{{route('programactivity.export', $program_activity->uuid)}}"  class="btn btn-outline-success"><i class="fa fa-file-excel-o"></i> Export Excel</a>
                </div>
            </div>
            <div class="card-body">

{{--                Finance Permission goes here--}}


                {!! Form::open(['route' => ['programactivity.submitPayment'], 'method'=>'POST']) !!}
                <input type="number" value="{{$program_activity->id}}" name="program_activity_id" hidden>
                <button type="button" class="btn btn-outline-info " data-toggle="modal" data-target="#exampleModal"><i class="fa fa-money"></i> Pay Selected</button>

{{--                Send payment for approval--}}

                @if($attendance->sum('amount_paid') > 0 and $paid_report->count() == 0)
                    <a href="#" data-toggle="modal" data-target="#exampleModal1" class="btn btn-primary" style="margin-left: 1%">Send payments for approval</a>
                @elseif($attendance->sum('amount_paid') > 0 and $paid_report->count() > 0)
                    <button class="btn btn-primary" style="margin-left: 1%">Edit submitted payment</button>
                @endif

                <br>

                <br>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Payment Amount</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label>Enter amount to pay<span class="text-danger">*</span></label>
                                <input type="number" name="amount_paid" class="form-control" required>
                                <label>Remarks<span class="text-danger">*</span></label>
                                <input type="textarea" name="remarks" class="form-control" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Confirm Payment</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->

{{--                Finance permssion ends here--}}

                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead >
                        <tr>
                            <th><input type="checkbox" class="selectall"></th>
                            <th >Name</th>
                            <th >Phone</th>
                            <th >Perdiem</th>
                            <th >Transportation</th>
                            <th>Other Cost</th>
                            <th >Total</th>
                            <th >Paid</th>
                            @if( $program_activity->wf_done == 1)
                                <th>Status</th>
                                <th >Action</th>
                            @endif

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($attendance as $key=> $participants)

                            <tr>
                                <td><input type="checkbox" name="ids[]" class="selectbox" value="{{$participants->requisition_training_cost_id}}"></td>

                                {!! Form::close() !!}
                                <td>{{$participants->first_name}} {{$participants->last_name}}</td>
                                <td>{{$participants->phone}}</td>
                                <td>{{number_2_format($participants->perdiem_total_amount)}}</td>
                                <td>{{number_2_format($participants->transportation)}}</td>
                                <td>{{number_2_format($participants->other_cost)}} <span class="text-default">{{$participants->others_description}}</span></td>
                                <td>{{number_2_format($participants->total_amount)}}</td>
                                <td>{{number_2_format($participants->amount_paid)}}</td>
                                    <td>
{{--                                            Check if participant was swaped--}}
                                            @if($participants->is_substitute == true)
                                                <span class="tag tag-yellow">Substituted</span>
                                            @endif

                                    </td>
                                    <td>
                                        <div class="row">

                                                <a href="{{route('programactivity.viewParticipantAttendance', $participants->id)}}" class="btn btn-primary" style="margin-left: 10%">View attendance</a>

                                        </div>

                                    </td>




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

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Amount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            {!! Form::open(['route' => ['finance.store_activity_payment'], 'method'=>'POST']) !!}
            <div class="modal-body">
                <div class="col-md-12 ">
                    <div class="card text-center">
                        <div class="card-body"> <span>You are paying total amount of</span>
                            <h1 class=" mb-1 mt-1 text-dark">{{number_2_format($attendance->sum('total_amount'))}} (TZS)</h1>
                            <div class="text-muted"><i class="si si-arrow-up-circle text-warning"></i> <span class=""></span> To {{$attendance->count()}} participants for an activity report: {{$program_activity_report->number}}</div>
                        </div>
                    </div>
                </div>
                <label>Remarks<span class="text-danger">*</span></label>
                <input type="text" name="remarks" class="form-control" >
            </div>
            <input type="number" value="{{$attendance->sum('total_amount')}}" name="total_amount" hidden>
            <input type="number" value="{{$requisition->region_id}}" name="region_id" hidden>
            <input type="number" value="{{$requisition->user_id}}" name="user_id" hidden>
            <input type="number" value="{{$requisition->amount}}" name="requested_amount" hidden>
            <input type="number" value="{{$requisition->id}}" name="requisition_id" hidden>
            <input type="number" value="{{$program_activity_report->id}}" name="program_activity_report_id" hidden>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Confirm Payment</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->




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


