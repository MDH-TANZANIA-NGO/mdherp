@extends('layouts.app')
@section('content')
    {{-- <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Activites</span>
    </div> --}}
    @include('project.activity.form.create')
    @if(Session::has('importedRows'))
        <div class="col-12">
            <div class="alert alert-success text-light alert-dismissible fade show" role="alert">
                {{ Session::get('importedRows') }} Record(s) Imported  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>            
            </div>
        </div>
    @endif

    @if(Session::has('importedDuplicates'))
        <div class="col-12">
            <div class="alert alert-danger text-light alert-dismissible fade show" role="alert">
                {{ Session::get('importedDuplicates') }} Record(s) Already Exist  
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>            
            </div>
        </div>
    @endif
    

    @include('project.activity.form.bulk_upload')
  
    {{-- <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List of Activities</span>
    </div> --}}


    <div class="col-lg-12 col-md-12">

    <div class="card">
        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">List of Activities</span>
                </div>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>
            
        </div>
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
