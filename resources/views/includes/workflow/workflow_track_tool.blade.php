<!-- start: page -->
<div class="row">

    <div class="col">
        <div class="accordion" id="accordion">
            <div class="card card-default" style="background-color: #fff">
                <div class="card-header" style="background-color: rgb(152, 186, 217)">
                    <h4 class="card-title m-0">
                        <a class="accordion-toggle" style="color: #000" data-toggle="collapse"
                           data-parent="#accordion" href="#collapse1Two"><i class="fa fa-bars"></i>
                             {!! $wf_track->wfDefinition->wfModule->name !!}</a> {{ __('label.workflow.index') }}
                    </h4>
                </div>
                <div id="collapse1Two" class="collapse">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <th>#</th>
                                <th>LEVEL</th>
                                <th>DESIGNATION</th>
                                <th>USER</th>
                                <th>COMMENT</th>
                                <th>RECEIVED DATE</th>
                                <th>FORWARDED DATE</th>
                                <th>STATUS</th>
                            </thead>
                            <tbody>
                                @foreach($completed_tracks as $key => $track)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $track->wfDefinition->level }}</td>
                                        <td>{{ $track->users->designation ? $track->users->designation->unit->name : '' }} {{ $track->users->designation ? $track->users->designation->name : '' }}</td>
                                        <td>{{ $track->users->full_name }}</td>
                                        <td>{{ $track->comments }}</td>
                                        <td>{{ $track->receive_date_formatted }}</td>
                                        <td>{{ $track->forward_date_formatted }}</td>
                                        <td>{!! $track->status_narration_badge !!}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

