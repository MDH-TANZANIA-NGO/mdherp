{{--Completed wf tracks--}}
@include('includes.workflow.workflow_track_tool')
@if($wf_done == 1 && $wf_track->user_id == access()->id())
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
{{-- <a href='#exampleModalCenter' class='btn btn-secondary' data-toggle='modal' id='approve_modal'>
    {{ __('label.action') }}
</a> --}}

<!-- Approve -->
@if(isset($statuses[1]))
    <a href='#' class='btn btn-success' onclick="event.preventDefault(); document.getElementById('workflow_approve_form').submit()">{{ $statuses[1] }}</a>
    <form id="workflow_approve_form" action="{{ route('workflow.update_workflow',$wf_track->id) }}" method="POST" class="d-none">
        @csrf
        {!! Form::hidden('action', "approve_reject") !!}
        {!! Form::hidden('comments', $statuses[1]) !!}
        {!! Form::hidden('status', 1) !!}
    </form>
@endif

<!-- Reverse -->
@if(isset($statuses[2]))
    <a href="#ReverseToLevelModel" class='btn btn-primary' data-toggle='modal' id='approve_modal'>Reverse to level</a>
    <div class="modal fade" id="ReverseToLevelModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content">
                @include('system/workflow/modal/reverse_model')
            </div>
        </div>
    </div>
@endif


<!-- rejected -->
@if(isset($statuses[5]))
<a href='#' class='btn btn-danger' data-toggle='modal'
onclick="event.preventDefault();if(confirm('Are you sure you want to reject this request')){
    $('#RejectModel').modal('show')
}">
{{ $statuses[5] }}</a>
@include('system/workflow/modal/reject_model')
@endif



@endif

{{--action button--}}
@if($wf_track->checkIfHasRightToRecallToPreviousWfTrack())
<a href='#' class='btn btn-warning' onclick="event.preventDefault();if(confirm('Are you sure you want to recall this application')){document.getElementById('workflow_recall_form').submit()}">
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
