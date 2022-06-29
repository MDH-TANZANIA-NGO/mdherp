@extends('layouts.app')
@section('content')
<form action="{{ route('interview.addapplicant') }} " method="post">
    <ul class="demo-accordion accordionjs m-0" data-active-index="false">
        <li class="acc_section">
            <div class="acc_head d-flex justify-content-between">
                <h3> Interview Date : {{ "" }} | Total Candidate : ({{  "" }}) </h3>
                 
            </div>
            <div class="acc_content" style="display: none;">
                @include('HumanResource.interview.datatables.scheduled')
            </div>
        </li>
       
    </ul>

    @include('HumanResource.interview.includes.shortlisted')
    @include('HumanResource.interview.includes.panelists')
</form>
@endsection