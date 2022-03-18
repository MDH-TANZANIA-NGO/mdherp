@extends('layouts.app')

@section('content')

    @permission('user_management')
   @include('user.profile.view_profile')
    @endpermission

    @permission('hr_dashboard')
    @include('user.profile.employee_details')
    @endpermission

    @endsection
