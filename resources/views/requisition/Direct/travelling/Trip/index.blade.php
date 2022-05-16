@extends('layouts.app')
@section('content')
   @include('requisition.Direct.travelling.forms.Trip.create')
    @include('requisition.Direct.travelling.datatables.trips')
@endsection
