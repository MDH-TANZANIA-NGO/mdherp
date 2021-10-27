@extends('layouts.app')
@section('content')
    {{-- <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">PROGRAM AREA</span>
    </div> --}}


    @include('project.program_area.form.create')



        {{-- Datatable starts here --}}
        {{-- <div class="row  mb-3">
            <span class="col-12 text-center font-weight-bold">List of Program Area</span>
        </div> --}}

        
        <div class="col-lg-12 col-md-12">
            <div class="card">

                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <div class="row text-center">
                        <span class="col-12 text-center font-weight-bold">List of Program Area</span>
                        </div>
                        <div class="card-options ">
                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        </div>
                    
                </div>

                <div class="card-body">

            <div class="table-responsive">
                @include('project.program_area.datatables.all')
            </div>
                </div>
            </div>

        </div>
                        
                

@endsection
