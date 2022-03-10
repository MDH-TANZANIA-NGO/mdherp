@push('after-styles')
    <style>
        #form_status{
            display: none;
        }
    </style>
@endpush

<!-- Modal -->

<div class="modal-header" style="background-color: #7ab9e1">
    <h5 class="modal-title" id="exampleModalLongTitle" style="color: #fff"><b>{{ __('label.workflow.index') }}</b></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{{--@if ($wf_track->status == 0)--}}
    {!! Form::open(['route' => ['workflow.update_workflow', $wf_track->id],'id'=>'approval_form']) !!}
    <div class="modal-body">

        <div class="card-body">

            {!! Form::hidden('assigned', $wf_track->assigned) !!}
            {!! Form::hidden('action', "approve_reject") !!}
            {{--{!! Form::hidden('user_id', $wf_track_level_prev_user_id) !!}--}}
            <div class="form-group">
                <label class="required_asterik" for="status">{{ __('label.action') }}</label>
                {!! Form::select('status', $statuses, null, ['class' => 'search-select workflow_status_select', 'style' => 'width:100%;border-radius:3px;height:32px;','required']) !!}
                <span class="help-block"></span>
            </div>

            <div class="field-layout reject_to_level mb-2">
                <div class="form-group">
                    <label class="required_asterik" for="level">{{ __('label.designation') }}</label>
                    {!! Form::select('level', $previous_levels, null, ['class' => 'reject_to_level_select','style'=>'width:100%;border-radius:3px;height:32px;','required'])
                     !!}
                </div>
            </div>

            @if($has_to_assign and isset($next_users))
            <div class="form-group assign_to_level mb-2">
            <label class="required" for="user">@lang('label.select_officer')</label>
            {!! Form::select('user', $next_users, [], ['class' => 'search-select assign_to_level_select', 'style' => 'width:100%;border-radius:3px;height:32px;','required' , 'placeholder' => 'Select']) !!}
            <span class="help-block"></span>
            </div>
            @endif

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
{{--@endif--}}

{{--
@push('after-scripts')
    <script>
        $( document ).ready(function() {
            $(".reject_to_level").hide();
            $("body").off("change", ".workflow_status_select").on("change", ".workflow_status_select", function (e) {
                var $status = $(this).val();
                switch($status) {
                    case '2':
                        $(".reject_to_level").show();
                        $(".assign_to_level").hide();
                        $( ".reject_to_level_select").prop( "disabled", false );
                        $( ".assign_to_level_select").prop( "disabled", false );
                        break;
                    case '4':
                        $(".reject_to_level").hide();
                        $(".assign_to_level").hide();
                        $( ".reject_to_level_select").prop( "disabled", false );
                        $( ".assign_to_level_select").prop( "disabled", false );
                        break;

                    default:
                        $(".reject_to_level").hide();
                        $( ".reject_to_level_select").prop( "disabled", true );
                        $( ".assign_to_level_select").prop( "disabled", false );
                        break;
                }
            });



        });

    </script>
@endpush--}}
