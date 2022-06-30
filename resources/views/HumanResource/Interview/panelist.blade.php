@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE:  {{ ""  }} </span>
		    <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO :  </span>
		</div>
    </div>
</div>
 
<form action="{{ route('interview.addpanelist') }} " method="post">
    @csrf
    @include('HumanResource.interview.includes.panelists')
    <input type="submit" value="next" class="btn btn-primary">
    <input type="text" name = "hr_requisition_job_id" value="{{ $interview->hr_requisition_job_id }}">
    <input type="text" name="interview_id" value="{{ $interview->id }}">
</form>
@endsection