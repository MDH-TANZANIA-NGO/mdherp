@extends('layouts.app')
@section('content')
<div class="row">
    <div class="">
        Total : {{ $applicants->count() }}
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">APPLICANT LIST</h3>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'interview.question.storeMarks']) !!}
            <input type="hidden" value="{{ $interview->id }}" name="interview_id">
             
            <div class="row mt-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>  Qno     </th>
                                <th>  Applicant </th>
                                <th>  Number  </th>
                                <th>  Status   </th>
                                <th>  Action   </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_questions = 0; ?>
                            @foreach($applicants as $key=>$applicant)
                            
                            <tr>
                                <td> {{($key+1) }}</td>
                                <td> {{$applicant->id}}</td>
                                <td> {{ $applicant->full_name }} </td>
                                <td> {{ $applicant->number }} </td>
                                <td>   
                                </td>
                                <td><a data-applicant_id="{{$applicant->id}}" data-toggle="modal" data-target="#edit" data-whatever="@mdo" href="#"> Add Marks </a></td>
                            </tr>
                            <?php $total_questions = ($key+1); ?>
                            @endforeach

                        </tbody>
                    </table>
                    <input type="hidden" name="total_questions" value="{{ $total_questions }}">

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
                <h5 class="modal-title" id="exampleModalLabel">Add Marks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'interview.question.update']) !!}
            @method('PUT')
            <div class="modal-body">
            <div class="row mt-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th> Qno</th>
                                <th>Question</th>
                                <th>Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_questions = 0; ?>
                            @foreach($questions as $key=>$question)
                            
                            <tr>
                                <td> {{($key+1) }}</td>
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
                    <input type="text" name="applicant_id" id="applicant_id" value=""  required/>
                    
                </div>
            </div>
                
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
        var applicant_id = $(event.relatedTarget).data('applicant_id'); // Button that triggered the modal
        $("#question").val(content);
        $("#question_id").val(id);
        $("#applicant_id").val(applicant_id);
    });
</script>
@endpush
@endsection