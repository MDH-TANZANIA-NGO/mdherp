@extends('layouts.app')
@section('content')
    <div class="row  mb-3">
        <span class="col-12 font-weight-bold">PROGRAM AREA: {{ $program_area->title }}</span>
    </div>
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                @include('project.program_area.form.edit')
            </div>
        </div>
    </div>

@endsection
