<div class="row">

<div class="col-md-12">
    <table class="table table-striped table-bordered" id="pending_datatable" style="background-color: #f5f5f5">
        <tbody>
        <tr>
            <th>DESIGNATION</th>
            <th>LEVEL</th>
            <th>DESCRIPTION</th>
            <th>COMMENT</th>
            <th>AGING DAY(S)</th>

        </tr>
        @foreach($pending_tracks as $pending_track)
            <tr>
                <td >{!! $pending_track->username_formatted !!}</td>
                {{--<th>{!! $pending_track->status_narration !!}</th>--}}
{{--                <td >{!! $pending_track->wfDefinition->level  !!}</td>--}}
                <td >{!! $pending_track->level_with_narration_budge  !!}</td>
                <th>{!! $pending_track->wfDefinition->description  !!}</th>
{{--                <td >{!! $pending_track->comment !!}</td>--}}
                <td >{!! $pending_track->comment_formatted !!}</td>
                <th>{!! $pending_track->getAgingDays() !!}</th>

            </tr>
        @endforeach


        </tbody>
    </table>

</div>


</div>
