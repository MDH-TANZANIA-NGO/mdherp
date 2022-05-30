@extends('layouts.app')
@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center flex-wrap gap-2">

                    <button class="btn btn-outline-info" data-toggle="modal" data-target="#largeModal"><i class="fa fa-filter"></i> Filter</button>
{{--                   <a href="{{route('compliance.export_beneficiaries')}}" class="btn btn-success" style="margin-bottom: 1%" > <i class="fe fe-download-cloud mr-2"></i>Export To Excel</a>--}}


                </div>
            </div>
        </div>
    </div>
    <!--end col-->

    <!-- Modal -->
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largemodal" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'designation.store']) !!}

                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        {!! Form::label('region', __("label.region"),['class'=>'form-label','required_asterik']) !!}
                                        {!! Form::select('region', $regions, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required', 'style'=>'width:100%']) !!}
                                        {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        {!! Form::label('Districts', __("Districts"),['class'=>'form-label','required_asterik']) !!}
                                        {!! Form::select('districts', $districts, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required','style'=>'width:100%']) !!}
                                        {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        {!! Form::label('Facilities', __("Facilities"),['class'=>'form-label','required_asterik']) !!}
                                        {!! Form::select('facilities', $facilities, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required','style'=>'width:100%']) !!}
                                        {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal"><i class="fa fa-file-excel-o"></i> Export Excel</button>
                    <button type="button" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


    <div class="row  mb-3">
        <span class="col-12 text-center font-weight-bold">Beneficiaries List</span>
    </div>


<div class="col-lg-12 col-md-12">

        <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-12" >

            <div class="table-responsive">

                @include('gofficer.gofficer.datatables.all')



            </div>
                </div>
        </div>
        </div>
    </div>
</div>

@endsection
