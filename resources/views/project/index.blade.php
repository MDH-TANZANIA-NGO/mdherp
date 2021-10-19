@extends('layouts.app')
@section('content')
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">PROJECTS</span>
    </div>
    @include('project.form.create')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                @include('project.datatables.all')
            </div>
        </div>
    </div>

@endsection
