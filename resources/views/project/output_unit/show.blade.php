@extends('layouts.app')
@section('content')
    {{-- <div class="row  mb-3">
        <span class="col-12 font-weight-bold">PROJECTS NAME: {{ $output_unit->title }}</span>
    </div> --}}
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                @include('project.output_unit.form.edit')
            </div>
        </div>
    </div>

@endsection
