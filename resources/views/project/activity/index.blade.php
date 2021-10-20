@extends('layouts.app')
@section('content')
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Activites</span>
    </div>
    @include('project.activity.form.create')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                @include('project.activity.datatables.all')
            </div>
        </div>
    </div>

@endsection
