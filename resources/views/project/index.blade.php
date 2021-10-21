@extends('layouts.app')
@section('content')


    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Register Project</span>
    </div>


    @include('project.form.create')


    {{-- Datatable starts here --}}


    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List of Projects</span>
    </div>


<div class="col-lg-12 col-md-12">
    
        <div class="card">
        <div class="card-body">
            <div class="row">

            <div class="table-responsive">
                @include('project.datatables.all')
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
