<!-- Timelime example  -->
<div class="row">
    <div class="col-md-12">
        <!-- The time line -->
        <div class="timeline">
            <!-- timeline time label -->
            <div class="time-label">
                <span class="bg-gray">{{ $model->wfTracks()->first()->created_at }}</span>
            </div>
            <!-- /.timeline-label -->

            @foreach($wfTracks as $wfTrack)

                <!-- timeline item -->
                <div>
                    <i class="fas fa-check-circle bg-gray"></i>
                    <div class="timeline-item col-5">
                        <span class="time"><i class="fas fa-clock"></i>
                            {!! $model->wfTracks()->where("wf_definition_id",$wfTrack->wf_definition_id)->where('wf_tracks.status',1)->orderBy('wf_tracks.id', 'asc')->first()->forward_date !!}
                        </span>
                        <h3 class="timeline-header no-border">
                            <b>
                                {!! $wfTrack->status_description !!}
                            </b>
                            <small class="ml-2 mr-2">By</small>
                            {{  $wfTrack->users->full_name }}
                        </h3>
                    </div>
                </div>
                <!-- END timeline item -->

            @endforeach

            @if($taf->wf_done_date)
                <div class="time-label">
                    <span class="bg-gradient-green">{{ $taf->wf_done_date }}</span>
                </div>
            @endif
        </div>
    </div>
    <!-- /.col -->
</div>
