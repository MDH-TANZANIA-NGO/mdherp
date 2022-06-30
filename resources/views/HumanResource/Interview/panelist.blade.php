@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE:  {{ $job_title->name }} </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE:  {{ $interview_type->name }} </span>
		    <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px"> REQUISITION NO :  </span>
		</div>
    </div>
</div>
 
<form action="{{ route('interview.addpanelist') }} " method="post">
    @csrf
    @include('HumanResource.interview.includes.panelists')
    
</form>
@endsection