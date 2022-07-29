@extends('layouts.app')
@section('content')
<div class="row">
    @include('HumanResource.HireRequisition.job._partials._shortlist_summary')
    @include('HumanResource.HireRequisition.job._partials._job_description')
    @include('HumanResource.HireRequisition.job._partials._online_applicants')
</div>
@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {
        $("#applicants").DataTable();
    })
</script>
@endpush