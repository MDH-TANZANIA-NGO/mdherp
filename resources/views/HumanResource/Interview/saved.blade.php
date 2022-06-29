@extends('layouts.app')
@section('content')
<form action="{{ route('interview.addapplicant') }} " method="post">
     @include('HumanResource.interview.includes.shortlisted')
     @include('HumanResource.interview.includes.panelists')
</form>    
@endsection