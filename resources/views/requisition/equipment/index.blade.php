@extends('layouts.app')
@section('content')


    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Register Equipment Category</span>
    </div>
    @include('requisition.equipment.equipment_type.form.create')

    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List Equipment Categories</span>
    </div>


    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-12" >

                        <div class="table-responsive">
                            @include('requisition.equipment.equipment_type.datatables.all')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Register Equipment</span>
    </div>
    @include('requisition.equipment.form.create')
     Datatable starts here
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List Equipments</span>
    </div>

    <div class="col-lg-12 col-md-12">

        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-12" >

                        <div class="table-responsive">
                            @include('requisition.equipment.datatables.all')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    <div class="col-lg-12 col-md-12">--}}

{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}

{{--                    <div class="col-12" >--}}

{{--                        <div class="table-responsive">--}}
{{--                            @include('requisition.equipment.datatable.all')--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    @include('requisition.equipment.equipment_type.assignment.index')--}}

@endsection
