@extends('layouts.app')
@section('content')
@csrf

<div class="card">
    <div class="card-header">
        <h3 class="card-title">INTERVIEW REPORT </h3>
    </div>
    <div class="card-body">
        <form action="{{ route('interview.report.initiate') }} " method="post">
            @csrf
            <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="form-label">Job </label>
                        {!! Form::select('hr_requisition_job_id',$designations,null,['class' => 'form-control select2', 'placeholder'=>'Select Job','required']) !!}
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="form-label">Interview</label>
                        <select id="interview_id" class="form-control select2-show-search" name="interview_id[]" data-placeholder="Select Interview" multiple required>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
                        <label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary">Initiate</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



    @endsection
    @push('after-scripts')
    <script>
        var $_hr_requisition_job_id = $("[name='hr_requisition_job_id']"); // Button that triggered the modal
        $_hr_requisition_job_id.change(function(e) {
            $_hr_requisition_job_id = $(this).val();
			url = "{{route('interview.report.getInterviewByJob',':hr_requisition_job_id')}}";
			url = url.replace(':hr_requisition_job_id', $_hr_requisition_job_id);
            var $_data = {
                hr_requisition_job_id: $(this).val(),
            };
            $.ajax({
                url: url,
                type: "get",
                dataType: 'json',
                success: function(data) {
                    //interview_type":"Written Interview","interview_date
                    var option = "";
					$.each(data, function(key, value) {
						option += "<option value='"+value.id+"'>" + value.interview_type+"("+value.interview_date+")" + "</option>";
					})
					$("#interview_id").html(option);
                    // console.log(data);
                }
            });
        });
    </script>
    @endpush
