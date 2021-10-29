@extends('layouts.app')
@section('content')

    <div class="col-12">
        @include('budget.fiscal_year.forms.create')
        @include('budget.fiscal_year.datatables.all')
    </div>

@endsection
