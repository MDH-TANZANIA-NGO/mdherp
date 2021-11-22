<div class="card" >
    <div class="accordion accordion-primary" id="accordion2Primary">
        <div class="card card-default">
            <div class="card-header">
                <h5 class="card-title m-0">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimaryOne" aria-expanded="true">
                        <label>@lang('label.wf_track') <i class="fas fa-list"></i></label>
                    </a>
                </h5>
            </div>
            <div id="collapse2PrimaryOne" class="collapse hide" style="">
                <div class="card-body">
                    @foreach($wf_tracks as $track)
                        <div class="row">
                            <div class="col-sm-2">Level</div>
                            <div class="col-sm-9">{{ number_format($track->wfDefinition->level, 1) }}</div>
                            @if($track->users->isStaff())
                                <div class="col-sm-2">Designation</div>
                                <div class="col-sm-9">{{ $track->users->staff->designation->name }}</div>
                                <div class="col-sm-2">Name</div>
                                <div class="col-sm-9">
                                    @if(isset($is_product_inspection))
                                        TBS
                                    @else
                                        {{ $track->users->staff->firstname }} {{ $track->users->staff->lastname }}
                                    @endif
                                </div>
                            @else
                                <div class="col-sm-2">Company Name</div>
                                <div class="col-sm-9">{{ $track->users->company()->first()->name }}</div>
                                <div class="col-sm-2">TIN number</div>
                                <div class="col-sm-9">{{ $track->users->company()->first()->tin_number }}</div>
                            @endif
                            <div class="col-sm-12">comment</div>
                            <div class="col-sm-12"><p class="alert alert-info" style="display: inline-block; margin-top:5px; margin-bottom: 5px">{{ $track->comments }}</p></div>
                            @if($track->users->isStaff())
                                <div class="col-sm-12">Received Date : {{ $track->receive_date_formatted }}</div>
                                <div class="col-sm-12">{{ $track->status_narration }} Date : {{ $track->forward_date_formatted }}</div>
                            @else
                            @endif
                            <div class="col-sm-2">Status</div>
                            <div class="col-sm-9">{!! $track->status_narration_badge !!}</div>
                        </div>
                        <div class="col-sm-12" style="background-color: grey; height: 3px; margin-top: 10px; margin-bottom: 10px"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>







@push('after-scripts')

    <script>
        $(function() {
            $("#toggle_section").slideDown();
            $( "#toggle_section_header" ).click(function(event) {
                $("#toggle_section").slideToggle();
            });
        });
    </script>
@endpush


