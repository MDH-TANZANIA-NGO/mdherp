<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">INTERVIEW QUESTION  MARKS</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'interview.question.storeMarks']) !!}
            <input type="hidden" value="{{ $interview->id }}" name="interview_id">
             
            <div class="row mt-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>Qno</th>
                                <th>Question</th>
                                <th>Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_questions = 0; ?>
                            @foreach($questions as $key=>$question)
                            
                            <tr>
                                <td> {{($key+1) }}</td>
                                <td> {{ $question->question }} </td>
                                <td>
                                     <input type="number" name="marks{{($key+1)}}"  required>
                                </td>
                            </tr>
                            <?php $total_questions = ($key+1); ?>
                            @endforeach

                        </tbody>
                    </table>
                    <input type="hidden" name="total_questions" value="{{ $total_questions }}">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'interview.question.update']) !!}
            @method('PUT')
            <div class="modal-body">
                <textarea class="form-control" type="text" id="question" name="question"></textarea>
                <input type="hidden" id="question_id" name="question_id">
                <input type="hidden" id="interview_id" name="interview_id" value="{{ $interview->id }}">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">update</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@push('after-scripts')
<script>
    $('#edit').on('show.bs.modal', function(event) {
        var content = $(event.relatedTarget).data('content'); // Button that triggered the modal
        var id = $(event.relatedTarget).data('id'); // Button that triggered the modal
        $("#question").val(content);
        $("#question_id").val(id);
</script>
@endpush