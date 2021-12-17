{{--Completed wf tracks--}}
@include('includes.workflow.workflow_track_tool')

@if($wf_done == 1 && $wf_track->user_id = access()->id())
    <a href='#' class='btn btn-warning' onclick="event.preventDefault();if(confirm('Are you sure you want to recall this application to your level')){document.getElementById('workflow_resume_form').submit()}">
        {{ __('label.recall') }}
    </a>
    <form id="workflow_resume_form" action="{{ route('workflow.resume_from_wf_done',$wf_track) }}" method="POST" class="d-none">
        @csrf
    </form>
@endif

{{--<br/>--}}
{{--Only access this when worklow is not completed--}}
@if($wf_done == 0)
    {{--Pending wf tracks--}}
    @include('includes/workflow/pending_wf_tracks')

    {{--action button--}}
    @if($wf_track->checkIfHasRightCurrentWfTrackAction())
        <a href='#exampleModalCenter' class='btn btn-secondary' data-toggle='modal' id='approve_modal'>
            {{ __('label.action') }}
        </a>
    @endif

    {{--action button--}}
    @if($wf_track->checkIfHasRightToRecallToPreviousWfTrack())
        <a href='#' class='btn btn-warning' onclick="event.preventDefault();if(confirm('Are you sure you want to recall this application')){document.getElementById('workflow_recall_form').submit()}" >
            {{ __('label.recall') }}
        </a>

        <form id="workflow_recall_form" action="{{ route('workflow.recall',$previous_wf_track) }}" method="POST" class="d-none">
            @csrf
        </form>
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
