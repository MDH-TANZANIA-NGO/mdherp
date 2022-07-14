@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('job_shortlister.index')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Shortlisters Reports</div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4 col-sm-4 col-lg-3">
        <a href="{{route('job_applicant_request.index')}}">
            <div class="card">
                <div class="card-body text-center">
                    <div class="h2 m-0"><i class="fa fas fa-ad"></i></div>
                    <div class="text-muted mb-0">Applicants Shortlited Reports</div>
                </div>
            </div>
        </a>
    </div>
</div>

@include('HumanResource.HireRequisition.job.forms.generate_shortlister_report')

@include('HumanResource.HireRequisition.job.forms.application_shortlist_report')

@endsection

