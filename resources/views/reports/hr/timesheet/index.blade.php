@extends('layouts.app')
@section('content')
    <div class="row">
        <h3>Timesheets</h3>
    </div>
    @include('reports.hr.timesheet.datatable.index')
@endsection
