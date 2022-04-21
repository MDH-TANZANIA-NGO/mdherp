@extends('layouts.app')
@section('content')


    <a href="{{route('compliance.export_beneficiaries')}}" class="btn btn-success" style="margin-bottom: 1%" > <i class="fe fe-download-cloud mr-2"></i>Export To Excel</a>



    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Beneficiaries List</span>
    </div>


<div class="col-lg-12 col-md-12">

        <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-12" >

            <div class="table-responsive">
               @if(access()->user()->permission == 30)
                @include('gofficer.gofficer.datatables.all')
                @else
                    @include('compliance.datatable.all')

                   @endif
            </div>
                </div>
        </div>
        </div>
    </div>
</div>

@endsection
