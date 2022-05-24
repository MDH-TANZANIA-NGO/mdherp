@extends('layouts.app')
@section('content')


    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Register Title</span>
    </div>
    @include('gofficer.gscale.form.create')
     Datatable starts here
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List Title</span>
    </div>


<div class="col-lg-12 col-md-12">

        <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-12" >

            <div class="table-responsive">
                @include('gofficer.gscale.datatables.all')
            </div>
                </div>
        </div>
        </div>
    </div>
</div>


    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Register Rate</span>
    </div>
    @include('gofficer.grate.form.create')
    {{-- Datatable starts here --}}
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List Rate</span>
    </div>


    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-12" >

                        <div class="table-responsive">
                            @include('gofficer.grate.datatables.all')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('gofficer.assignment.index')

@endsection
