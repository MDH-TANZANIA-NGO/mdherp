@extends('layouts.app')
@section('content')
    <div class="row">
        <span class="col-12 text-center">PROJECTS</span>
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
