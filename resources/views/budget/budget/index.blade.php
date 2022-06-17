@extends('layouts.app')

@section('content')
    @include('budget.budget.forms.create')
    @include('budget.budget.datatables.all')
@endsection

