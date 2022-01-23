<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">ACTIVITY SUMMARY</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
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
                    @foreach($program_activity as $details)
                        <tr>

                            <td>{{$details->training->district->name}}</td>
                            <td>{{$details->training->from}}</td>
                            <td>{{$details->training->to}}</td>

                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->
        </div>
    </div>
</div>



@foreach($program_activity as $program_activity)

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
@endforeach

<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">PARTICIPANTS DETAILS</h3>
            <div class="card-options ">


                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>

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
                        <th>Status</th>
                        <th>Action</th>


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
                                    @if($participants->is_substitute == true)
                                        <span class="tag tag-yellow">Substituted</span>
                                    @endif
                                    @if($participants->attend == true)
                                        <span class="tag tag-green">Attended</span>
                                    @endif
                                    @if($participants->attend == false)
                                        <span class="tag tag-gray">Not Attended</span>
                                    @endif
                                        @if($participants->amount_paid == null)
                                            <span class="tag tag-red">Not Verified</span>
                                        @else
                                            <span class="tag tag-light-green"> Verified</span>
                                        @endif

                                          </td>
                                <td>
                                {{--                                <a href="{{ route('programactivity.pay',$participants->uuid) }}" class="btn btn-success"  >Pay</a>--}}
                                <a href="{{ route('programactivity.pay',$participants->uuid) }}" class="btn btn-outline-primary"  ><i class="fa fa-eye"></i></a>
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
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
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


