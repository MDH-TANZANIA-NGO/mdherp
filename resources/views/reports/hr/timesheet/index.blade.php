@extends('layouts.app')
@section('content')
    <div class="row">
        <h3>Timesheets</h3>
    </div>

    <div class="row">
        <div class="col-6 mt-2">
            <label class="form-label">Select Month</label>
            <select name="month" id="select-month" class="form-control custom-select month">
                @foreach($months as $month)
                    <option value="{{$month->month_year}}">{{ $month->month_year }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @include('reports.hr.timesheet.datatable.index')
@endsection
