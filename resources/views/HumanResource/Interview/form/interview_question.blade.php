<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE: {{ $job_title->name }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE: {{ $interview_type->name }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> INTERVIEW NUMBER : {{ $interview->number }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> INTERVIEW DATE : {{ $interview_date }} </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">INTERVIEW QUESTION </h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'interview.question.store']) !!}
            <input type="hidden" value="{{ $interview->id }}" name="interview_id">
            <div class="row">
                <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2">
                    <label class="form-label">Question </label>

                </div>
                <div class="col-md-5 col-sm-5 col-lg-5 col-xl-5">
                    <textarea type="text" name="question" class="form-control" placeholder="enter interview question here ..." required></textarea>
                </div>
                <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2">
                    <input type="number" name="marks" class="form-control" placeholder="enter marks ..." required>
                </div>
                <div class="col-md-2 col-sm-2 col-lg-2 col-xl-2">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th> Qno</th>
                                <th>Question</th>
                                <th>Marks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($questions as $key=>$question)
                            
                            <tr>
                                <td> {{($key+1) }}</td>
                                <td> {{ $question->question }} </td>
                                <td> {{ $question->marks }} </td>
                                <td>
                                    <a data-id="{{ $question->id }}" data-content="{{$question->question}}" data-toggle="modal" data-target="#edit" href="">Edit</a> |
                                    <a href="{{ route('interview.question.destroy',$question->uuid) }}">Delete </a>
                                </td>
                            </tr>
                           
                            @endforeach
                            <tr>
                                <td> Total </td>
                                <td>   </td>
                                <td>  {{ $questions->sum('marks') }} </td>
                                <td> </td>
                               
                            </tr>
                        </tbody>
                    </table>
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
                <input type="text" id="question_id" name="question_id">
                <input type="text" id="interview_id" name="interview_id" value="{{ $interview->id }}">
                
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
        // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        // var modal = $(this);
        // modal.find('.modal-title').text('New message to ' + recipient);
        // modal.find('.modal-body input').val(recipient);
    })
</script>
@endpush