@extends('layouts.app')
@section('content')
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Sub Programs</span>
    </div>
    @include('project.sub_program.form.create')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                @include('project.sub_program.datatables.all')
            </div>
        </div>
    </div>

@endsection
