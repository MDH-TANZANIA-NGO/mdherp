@push('after-styles')
    <style>
        #form_status{
            display: none;
        }
    </style>
@endpush

<!-- Modal -->

<div class="modal fade" id="RejectModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="modal-content">

<div class="modal-header" style="background-color: #7ab9e1">
    <h5 class="modal-title" style="color: #fff"><b>{{ __('label.workflow.index') }}</b></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

    {!! Form::open(['route' => ['workflow.update_workflow', $wf_track->id],'id'=>'approval_form']) !!}
    <div class="modal-body">

        <div class="card-body">

            {!! Form::hidden('assigned', $wf_track->assigned) !!}
            {!! Form::hidden('action', "approve_reject") !!}
            {!! Form::hidden('status', 5) !!}
            <div class="form-group mb-2">
                <label class="required_asterik" for="comments">{{ __('label.comment') }}</label>
                {!! Form::textarea('comments', null, ['class' => 'form-control textarea autosize', 'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal;border-radius: 3px;','required']) !!}
            </div>



        </div>


    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit_approval_modal">{{ __('label.submit') }}</button>
        <span id="form_status"></span>
        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('label.cancel') }}</button>
    </div>
    {!! Form::close() !!}

        </div>
    </div>
</div>

