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
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largemodal1">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'designation.store','class'=>'card']) !!}
                    <div class="card-body">
                        <div class="example">
                            <div class="row" >
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('Unit', __("Unit"),['class'=>'form-label','required_asterik']) !!}
                                        {!! Form::text('unit',null,['class' => 'form-control', 'placeholder' => 'HIV/TB Prevention','required']) !!}
                                        {!! $errors->first('designation', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('designation', __("Designation"),['class'=>'form-label','required_asterik']) !!}
                                        {!! Form::select('designation', ['Officer'=>'Officer','Manager'=>'Manager', 'Assistance'=>'Assistance','Advisor'=>'Advisor'], null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}

                                        {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! Form::label('department', __("Department"),['class'=>'form-label','required_asterik']) !!}
                                        {!! Form::select('department', $departments, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}

                                        {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>



                            </div>
                            <button type="submit" class="btn btn-info" style="margin-left:45%;"><i class="fa fa-plus-circle mr-2"></i>Add</button>

                        </div>

                    </div>
                </div>

                {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
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
