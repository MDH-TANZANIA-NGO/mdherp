@extends('layouts.app')
@section('content')


    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Register Title</span>
    </div>
    @include('requisition.equipment.form.create')
     Datatable starts here
    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">List Title</span>
    </div>


{{--    <div class="col-lg-12 col-md-12">--}}

{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}

{{--                    <div class="col-12" >--}}

{{--                        <div class="table-responsive">--}}
{{--                            @include('requisition.equipment.datatables.all')--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


{{--    <div class="row  mb-3">--}}
{{--        <span class="col-12 text-center font-weight-bold">Register Rate</span>--}}
{{--    </div>--}}
{{--    @include('requisition.equipment.form.create')--}}
{{--    --}}{{-- Datatable starts here --}}
{{--    <div class="row  mb-3">--}}
{{--        <span class="col-12 text-center font-weight-bold">List Rate</span>--}}
{{--    </div>--}}


{{--    <div class="col-lg-12 col-md-12">--}}

{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}

{{--                    <div class="col-12" >--}}

{{--                        <div class="table-responsive">--}}
{{--                            @include('requisition.equipment.datatables.all')--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    @include('requisition.equipment.assignment.index')

@endsection
