<div class="col-sm-10 mx-auto">
    @include('system.workflow.external_tracks')

    @if ($wf_track->status == 0)
        @if(!$has_participated)
            <div class="row">
                <div class="col-sm-3 mt-2">
                    <button type="button" class="col-sm-12 btn btn-warning" data-toggle="modal" data-target="#external-reject-modal">Reject</button>
                </div>
                <div class="col-sm-3 mt-2">
                    {!! Form::open(['route' => ['workflow.update_workflow', $wf_track->id],'name' => 'client-approval']) !!}
                    {{--{!! Form::hidden('assigned', $wf_track->assigned) !!}--}}
                    {!! Form::hidden('action', "approve_reject") !!}
                    {!! Form::hidden('status', 1) !!}
                    <input type="submit" name="accept" value="Accept" id="accept" class="col-sm-12 btn btn-success">
                    {!! Form::close() !!}
                </div>
            </div>
        @endif
    @endif



    <div class="modal fade" id="external-reject-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('label.reject')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => ['workflow.update_workflow', $wf_track->id],'class' => 'form-horizontal p-3', 'id'=>'appform']) !!}
                    {!! Form::hidden('action', "approve_reject") !!}
                    {!! Form::hidden('status', 2) !!}
                    {!! Form::hidden('level', $previous_level) !!}

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">@lang('label.comments'):</label>
                        {!! Form::textarea('comments', null, ['class' => 'form-control', 'id' => "description", 'autofocus', 'rows' => 8, 'cols' => 20, 'placeholder'=>'Write comments here...', 'required']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">@lang('label.submit')</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        $(document).ready(function () {
            $(':input[name="accept"]').click(function () {
                var confirmation = confirm('By clicking OK button, You declare that the details furnished are true and correct');
                if (confirmation == true) {
                    $("form[name='client-approval']").submit();
                } else {
                    return false;
                }
            })
        })
    </script>
@endpush
