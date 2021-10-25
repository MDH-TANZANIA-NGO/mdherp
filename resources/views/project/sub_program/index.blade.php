@extends('layouts.app')
@section('content')
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Sub-Program Area</span>
    </div>


    @include('project.sub_program.form.create')

    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List of Sub-Program Areas</span>
    </div>

    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-body">

            <div class="row">
        
            <div class="table-responsive">
                @include('project.sub_program.datatables.all')
            </div>
            </div>
            </div>
    </div>

    </div>

@endsection
