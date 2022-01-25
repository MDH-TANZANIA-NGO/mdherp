<table class="table table-striped table-bordered">
    <thead >
    <tr>

        <th >Amount</th>
        <th >MSISDN</th>
        <th >Remarks</th>



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
