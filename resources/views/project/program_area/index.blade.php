@extends('layouts.app')
@section('content')
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">PROGRAM AREA</span>
    </div>
    @include('project.program_area.form.create')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                @include('project.program_area.datatables.all')
            </div>
        </div>
    </div>

@endsection
