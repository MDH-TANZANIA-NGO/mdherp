@extends('layouts.app')
@section('content')
    <form action="{{ route('interview.notifyapplicant') }} " method="post">
        @csrf
        @include('HumanResource.interview.header')
        @include('HumanResource.interview.panelist.show')
        @include('HumanResource.interview.applicant.selected_for_invitation')  
    </form>
    <form action="{{ route('interview.addapplicant') }} " method="post">
        @if(count($interviewApplicants))
            @include('HumanResource.interview.includes.shortlisted')   
        @endif
    </form>
@endsection