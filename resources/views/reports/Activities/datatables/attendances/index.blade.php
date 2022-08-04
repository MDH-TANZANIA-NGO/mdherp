
<div class="table-responsive">
    <table id="items" class="table table-striped table-bordered">
        <thead >
        <tr>

            <th >Full name</th>
            <th >Phone</th>
{{--            <th >Requested</th>--}}
            <th >Date</th>
            <th >Time in</th>
            <th >Time Out</th>
            <th >Location</th>


        </tr>
        </thead>
        <tbody>
        <tr>
            @foreach($attendances->allByHotspot($hotspot->id) as $attendance)
                @if($attendance->creator_type == 'App\Model\GOfficer')
            <td><i class="fa fa-check-circle-o mr-1 text-success"></i>{{$attendance->gOfficer->first_name}}</td>
            <td>{{$attendance->gOfficer->phone}}</td>
{{--            <td>680000</td>--}}
            <td>{{date('d-m-Y', strtotime($attendance->checkin_time))}}</td>
            <td>{{date('Gi.s', strtotime($attendance->checkin_time))}}</td>
                    <td>{{date('Gi.s', strtotime($attendance->checkout_time))}}</td>
            <td>{{$attendance->checkin_location}}</td>
                @elseif($attendance->creator_type == 'App\Model\User')

                        <td><i class="fa fa-check-circle-o mr-1 text-success"></i>{{$attendance->user->full_name_formatted}}</td>
                        <td>{{$attendance->user->phone}}</td>
                        {{--            <td>680000</td>--}}
                        <td>{{date('d-m-Y', strtotime($attendance->checkin_time))}}</td>
                        <td>{{date('Gi.s', strtotime($attendance->checkin_time))}}</td>
                        <td>{{date('Gi.s', strtotime($attendance->checkout_time))}}</td>
                        <td>{{$attendance->checkin_location}}</td>
                @endif
            @endforeach
        </tr>


        </tbody>
    </table>
</div>
@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#items").dataTable()
        })
    </script>

@endpush
