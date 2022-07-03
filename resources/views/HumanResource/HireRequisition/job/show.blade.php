@extends('layouts.app')
@section('content')
<div class="row">
    @include('HumanResource.HireRequisition.job._partials._shortlist_summary')
    @if($hire_requisition_job->shortlists()->count())
    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
        <a href="" class="btn btn-primary pull-right">Submit to workflow</a>
    </div>
    @endif
    @include('HumanResource.HireRequisition.job._partials._job_description')
    @include('HumanResource.HireRequisition.job._partials._online_applicants')
</div>
@endsection