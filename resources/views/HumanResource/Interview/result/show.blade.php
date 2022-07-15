@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">TOTAL APPLICANTS: {{ $applicants->count() }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE: {{ $interview_type->name }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">PENDING : {{ $pending }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">COMPLETED : {{ $completed }} </span>
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
                                <th> # </th>
                                <th> Applicant </th>
                                <th> Number </th>
                                <th> Marks </th>
                                @if(isset($has_report) && $has_report != 1 )
                                <th> Action </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_questions = 0; ?>
                            @foreach($applicants as $key=>$applicant)
                            <tr>
                                <td> {{($key+1) }}</td>
                                <td> {{ $applicant->first_name }} {{ $applicant->middle_name }} {{ $applicant->last_name }} </td>
                                <td> {{ $applicant->number }} </td>
                                <td> {{ number_format($applicant->marks,2) }} </td>
                                <td><a data-interview_id="{{ $interview->id }}" data-applicant_id="{{$applicant->id}}" data-toggle="modal" data-target="#edit" data-whatever="@mdo" href="#"> view </a></td>
                            </tr>
                            <?php $total_questions = ($key + 1); ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Result By Panelist </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => 'interview.question.storeMarks','method'=> 'post']) !!}
            <div class="modal-body">
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-stripped" id="panelist-result-table">
                            <thead>
                                <tr>
                                    <th>Panelist</th>
                                    <th>Marks </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2"> Loading ... </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        var $_applicant_id = button.data('applicant_id'); // Button that triggered the modal
        var $_interview_id = button.data('interview_id'); // Button that triggered the modal
        var $_data = {
            applicant_id: $_applicant_id,
            interview_id: $_interview_id
        };
        $.ajax({
            url: "{{route('interview.result.panelist_aggrigate')}}",
            type: "get",
            data: $_data,
            dataType: 'json',
            success: function(data) {
                if (data.length) {
                    tr = "";
                    $.each(data, function(key, value) {
                        tr += `<tr><td>${value.full_name}</td><td>${value.marks}</td></td>`;
                    });
                    $("#panelist-result-table tbody").html(tr);
                } else {
                    $("#panelist-result-table tbody").html('<tr><td colspan="2"> No Result Found. </td></tr>');
                }

            }
        });
    }).on('hidden.bs.modal', function() {
        $("#panelist-result-table tbody").html('<tr><td colspan="2"> Loading ... </td></tr>');
    });
</script>
@endpush
@endsection