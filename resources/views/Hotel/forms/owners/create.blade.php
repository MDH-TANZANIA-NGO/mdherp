@extends('layouts.app')
@section('content')


    <div class="row  mb-3">
        <span class="col-12 text-left font-weight-bold">Register Vendor</span>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            {!! Form::open(['route' => 'admin.register_owner','class'=>'card']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('first_name', __("First Name"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('first_name',old('first_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('middle_name', __("Middle Name"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('middle_name',old('middle_name'),['class' => 'form-control', 'placeholder' => '']) !!}
                            {!! $errors->first('middle_name', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('last_name', __("Last Name"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('last_name',old('last_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('last_name', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('phone', __("Phone"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('phone',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('email', __("Email"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::email('email', null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('g_scale', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                             <div class="col-md-4">
                                 <div class="form-group ">
                                     {!! Form::label('regions', __("Region"),['class'=>'form-label','required_asterik']) !!}
                                     {!! Form::select('region_id', $regions, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                     {!! $errors->first('region_id', '<span class="badge badge-danger">:message</span>') !!}
                                 </div>
                             </div>
                    <div class="col-md-12">
                        <div class="form-group ">
                            {!! Form::label('address', __("Address"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('address', null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('address', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

{{--                    <div class="col-md-4">--}}
{{--                        <div class="form-group ">--}}
{{--                            {!! Form::label('district', __("District"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                            {!! Form::select('district_id', $districts, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}--}}
{{--                            {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="form-group ">--}}
{{--                            {!! Form::label('Facilities', __("Facilities"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                            {!! Form::select('facilities[]', $facilities, null, ['class' =>'form-control select2-show-search', 'aria-describedby' => '','multiple']) !!}--}}
{{--                            {!! $errors->first('facilities', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    <button type="submit" class="btn btn-info" style="margin-left:45%;"><i class="fa fa-paper-plane mr-2"></i>Submit</button>

                </div>
            </div>

            {!! Form::close() !!}

            </div>


        </div>
@endsection
