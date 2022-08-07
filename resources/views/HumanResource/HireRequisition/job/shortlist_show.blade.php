@extends('layouts.app')
@section('content')
<div class="row">
    @include('HumanResource.HireRequisition.job._partials._shortlist_summary')
    @include('HumanResource.HireRequisition.job._partials._job_description')
    @include('HumanResource.HireRequisition.job._partials._online_applicant_shortlist')
</div>
@endsection