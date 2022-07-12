@extends('layouts.app')
@section('content')
<form action="{{ route('interview.notifyapplicant') }} " method="post">
    @csrf
    @include('HumanResource.interview.header.main')
    @include('HumanResource.interview.panelist.show')
    @include('HumanResource.interview.applicant.invited')
</form>
@if(count($interviewApplicants))
<form action="{{ route('interview.addapplicant') }} " method="post">
    <div class="row mb-3">
        <label class="form-label col-sm-2 ">Interview Date </label>
        <div class="col-sm-3 ">
            <input type="datetime-local" class="form-control" min="<?php echo  date('Y-m-d\TH:i'); ?>" name="interview_date" required>
        </div>
        <div class="col-lg-2">
            <label class="form-label">Location </label>
        </div>
        <div class="col-lg-3">
            {!! Form::select('district_id',$districts,null,['class' => 'form-control select2-show-search','placeholder'=>'Select district','required'=>'true']) !!}
        </div>
    </div>
    <div class="row mb-3">
        <label class="form-label  col-sm-2">Extra Details </label>
        <div class="col-lg-12">
            <textarea class="form-control" name="description" required></textarea>
        </div>
    </div>
    <input type="hidden" name="interview_id" value="{{ $interview->id }}">
    <div class="row mb-3">
        <div class="col-sm-2 ">
            <input type="submit" id="add_applicant" class="btn btn-primary btn-inline-block" name="submit" value="Add Applicant To Interview">
        </div>
    </div>
    @include('HumanResource.interview.applicant.shortlisted')
    @endif
</form>
@endsection
@push('after-scripts')
<script>
    $(document).ready(function() {
        $('#add_applicant').click(function() {
            checked = $("input[type=checkbox]:checked").length;
            if (!checked) {
                alert("You must select  at least one applicant.");
                return false;
            }
        });
    });
</script>
@endpush