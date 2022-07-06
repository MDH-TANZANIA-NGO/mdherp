@extends('layouts.app')
@section('content')
<form action="{{ route('interview.notifyapplicant') }} " method="post">
    @csrf
    @include('HumanResource.interview.header')
    @include('HumanResource.interview.panelist.show')
    @include('HumanResource.interview.applicant.selected_for_invitation')
</form>
<form action="{{ route('interview.addapplicant') }} " method="post">
    <div class="row mb-3">
        <label class="form-label col-sm-2 ">Interview Date </label>
        <div class="col-sm-3 ">
            <input type="datetime-local" class="form-control" name="interview_date" required>
        </div>
        <div class="col-lg-2">
            <label class="form-label">Location </label>
        </div>
        <div class="col-lg-3">
            {!! Form::select('district_id',$districts,null,['class' => 'form-control select2','data-placeholder'=>'Select district','required']) !!}
        </div>
       

    </div>
    <div class="row">
        <label class="form-label  col-sm-2">Location Description </label>
        <div class="col-lg-12">
            <textarea class="form-control" name="description" required></textarea>
        </div>
    </div>


    <input type="hidden" name="interview_id" value="{{ $interview->id }}">
    <div class="row mb-3">
        <div class="col-sm-2 ">
            <input type="submit" class="btn btn-primary btn-inline-block" name="submit" value="Add Applicant To Interview">
        </div>
    </div>
    @if(count($interviewApplicants))
    @include('HumanResource.interview.applicant.shortlisted')
    @endif
</form>
@endsection