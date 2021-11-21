@extends('layouts.app')
@section('content')
    @include('requisition.travelling.datatables.all')
    @include('requisition.travelling.forms.create')

@endsection
