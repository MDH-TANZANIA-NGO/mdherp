
{{--Completed wf tracks--}}
@include('includes.workflow.workflow_track_tool')
{{--<br/>--}}
{{--Only access this when worklow is not completed--}}
@if($wf_done == 0 || $wf_done == 3)
    {{--Pending wf tracks--}}
    @include('includes/workflow/pending_wf_tracks')

    {{--action button--}}
    @if($wf_track->checkIfHasRightCurrentWfTrackAction())
        <a href='#exampleModalCenter' class='btn btn-secondary' data-toggle='modal' id='approve_modal'>
            {{ __('label.action') }}
        </a>
    @endif


    {{--Workflow modals--}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content">
                @include('system/workflow/modal/Approval_model')
            </div>
        </div>
    </div>

@endif
