@extends('layouts.app')

@section('content')
    <a href="{{route('compliance.export_beneficiaries')}}" class="btn btn-success" style="margin-bottom: 1%" > <i class="fe fe-download-cloud mr-2"></i>Export To Excel</a>

    @include('compliance.datatable.all')

@endsection
