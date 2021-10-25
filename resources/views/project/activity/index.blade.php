@extends('layouts.app')
@section('content')
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Activites</span>
    </div>
    @include('project.activity.form.create')


    <div class="col-lg-12 col-md-12">

    <div class="card">
        <div class="card-body">

        <div class="row">
        
            <div class="table-responsive">
                @include('project.activity.datatables.all')
            </div>
        
        </div>
        </div>
    </div>
    </div>

@endsection
