@extends('layouts.app')
@section('content')

    @include('PublicHoliday.forms.create')

    @include('PublicHoliday.datatables.all')
    @endsection
