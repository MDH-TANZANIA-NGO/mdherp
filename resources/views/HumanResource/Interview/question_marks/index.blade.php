@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">TOTAL APPLICANTS:  {{ $applicants->count() }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE:  {{ $interview_type->name }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">PENDING :  {{ $pending }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">COMPLETED :  {{ $completed }} </span>
            {!! Form::open(['route' => 'interview.submitForReport']) !!}
                @if(isset($has_report) && $has_report != 1 )
                <span class="tag tag-rounded pull-right"> <input type="submit" value="SUBMIT FOR REPORT" class="btn btn-primary"></span>
                <input type="hidden" value="{{ $interview->id }}" name="interview_id">
                @endif
                @if(isset($has_report) && $has_report == 1 )
                <span class="tag tag-rounded pull-right"> <input type="submit" value="EDIT" class="btn btn-primary"></span>
                @endif
            {!! Form::close() !!}
		</div>
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
                                <th>  #     </th>
                                <th>  Applicant </th>
                                <th>  Number </th>
                                <th>  Marks  </th>
                                @if(isset($has_report) && $has_report != 1 )
                                <th>  Action   </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_questions = 0; ?>
                            @foreach($applicants as $key=>$applicant)
                            
                            <tr>
                                <td> {{($key+1) }}</td>
                                <td> {{ $applicant->first_name }} {{ $applicant->middle_name }}  {{ $applicant->last_name }} </td>
                                <td> {{ $applicant->number }} </td>
                                <td> {{ $applicant->marks }} </td>
                                @if(isset($has_report) && $has_report != 1 )
                                <td><a data-applicant-name="{{ $applicant->first_name }} {{ $applicant->middle_name }}  {{ $applicant->last_name }}" data-interview_id = "{{ $interview->id }}" data-applicant_id="{{$applicant->id}}" data-toggle="modal" data-target="#edit" data-whatever="@mdo" href="#"> Add Marks </a></td>
                                @endif
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
                <h5 class="modal-title" id="applicant_name">Add Marks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'interview.question.storeMarks','method'=> 'post']) !!}
            <div class="modal-body">
            <div class="row mt-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th> Qno</th>
                                <th>Question</th>
                                <th>Unit Marks</th>
                                <th>Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_questions = 0; ?>
                            @foreach($questions as $key=>$question)
                            
                            <tr>
                                <td> {{($key+1) }}</td>
                                <td> {{ $question->question }} </td>
                                <td> {{ $question->marks }} </td>
                                <td>
                                     <input type="number" min="0" max="{{$question->marks}}" name="marks{{($key+1)}}"  required>
                                     <input type="hidden"  value="{{$question->id}}" name="question{{($key+1)}}"  required>
                                </td>
                            </tr>
                            <?php $total_questions = ($key+1); ?>
                            @endforeach

                        </tbody>
                    </table>
                    <input type="hidden" name="total_questions" value="{{ $total_questions }}">
                    <input type="hidden" name="applicant_id" id="applicant_id" value=""  required/>
                    <input type="hidden" name="interview_id" id="interview_id" value=""  required/>
                    
                </div>
            </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">submit</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@push('after-scripts')
<script>
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var content = button.data('content'); // Button that triggered the modal
        var id = button.data('id'); // Button that triggered the modal
        var applicant_id = button.data('applicant_id'); // Button that triggered the modal
        var interview_id = button.data('interview_id'); // Button that triggered the modal
        $("#question").val(content);
        $("#question_id").val(id);
        $("#applicant_id").val(applicant_id);
        $("#interview_id").val(interview_id);
    });
</script>
@endpush
@endsection