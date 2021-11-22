<!-- start: page -->
<div class="row">

    <div class="col">
        <div class="accordion" id="accordion">
            <div class="card card-default" style="background-color: #fff">
                <div class="card-header">
                    <h4 class="card-title m-0">
                        <a class="accordion-toggle" style="color: #000" data-toggle="collapse"
                           data-parent="#accordion" href="#collapse1Two"><i class="fas fa-eye"> </i>
                             {!! $wf_track->wfDefinition->wfModule->name !!}</a> {{ __('label.workflow.index') }}
                    </h4>
                </div>
                <div id="collapse1Two" class="collapse">
                    <div class="card-body">
                        @foreach($completed_tracks as $track)
                        <div class="row">
                            <div class="col-sm-2">Level</div>
                            <div class="col-sm-9">{{ $track->wfDefinition->level }}</div>
                            <div class="col-sm-2">Designation</div>
                            <div class="col-sm-9">
                                {{ $track->users->designation->unit->name }} {{ $track->users->designation->name }}
                            </div>
                            <div class="col-sm-2">Name</div>
                            <div class="col-sm-9">{{ $track->users->full_name }}</div>
                            <div class="col-sm-12">comment</div>
                            <div class="col-sm-12"><p class="alert" style="border: 1px solid #000; background-color:
                            #fff;
                            color: #000; display:
                            inline-block;
                            margin-top:5px; margin-bottom:
                            5px">{{ $track->comments }}</p></div>
                            <div class="col-sm-12">Received Date : {{ $track->receive_date_formatted }}</div>
                            <div class="col-sm-12">{{ $track->status_narration }} Forwarded Date : {{ $track->forward_date_formatted }}</div>
                            <div class="col-sm-2">Status</div>
                            <div class="col-sm-9">{!! $track->status_narration_badge !!}</div>
                        </div>
                        <hr class="dotted">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

