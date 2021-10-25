@extends('layouts.app')
@section('content')
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">PROGRAM AREA</span>
    </div>


    @include('project.program_area.form.create')



        {{-- Datatable starts here --}}
        <div class="row  mb-3">
            <span class="col-12 text-center font-weight-bold">List of Program Area</span>
        </div>

        
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
    
                   

            <div class="table-responsive">
                @include('project.program_area.datatables.all')
            </div>
                </div>
            </div>

        </div>
                        
                

@endsection
