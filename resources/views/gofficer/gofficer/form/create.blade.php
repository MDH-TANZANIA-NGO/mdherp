@extends('layouts.app')
@section('content')


    <div class="row  mb-3">
        <span class="col-12 text-left font-weight-bold">Individual External Users Registration</span>
    </div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        {!! Form::open(['route' => 'g_officer.store','class'=>'card']) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('first_name',old('first_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('middle_name', __("label.name.middle"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('middle_name',old('middle_name'),['class' => 'form-control', 'placeholder' => '']) !!}
                        {!! $errors->first('middle_name', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('last_name', __("label.name.last"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('last_name',old('last_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('last_name', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('phone',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('g_scale', __("Title"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('g_scale', $g_scales, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('g_scale', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
       {{--         <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('regions', __("Region"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('region_id', $regions, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('region_id', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>--}}
                {!! Form::text('check_no',null,['class' => 'form-control', 'placeholder' => '','hidden']) !!}
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('district', __("District"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('district_id', $districts, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>


                <button type="submit" class="btn btn-info" style="margin-left:45%;"><i class="fa fa-paper-plane mr-2"></i>Submit</button>

            </div>
        </div>

        {!! Form::close() !!}
        <div class="row  mb-3">
            <span class="col-12 text-left font-weight-bold">Bulk External Users Registration</span>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
               {{-- <form action="{{ route('g_officer.import') }}" method="POST" enctype="multipart/form-data">
                <input type="file" class="dropify" data-height="180" name="file" />
                    <div class="row" style="margin-left: 45%">
                        <br>
                        <span class="text-gray text-small">(Max 100 rows)</span>
                        <br>
                        <br>

                    </div>
                    <div class="row" style="margin-left: 45%">
                        <button type="submit" class="btn btn-info"><i class="fe fe-upload mr-2"></i>Upload</button>
                    </div>
                        --}}{{--            <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>--}}{{--


                </form>--}}
                <form action="{{ route('g_officer.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="dropify">
                    <div class="row" style="margin-left: 43%">
                        <br>
                        <span class="text-gray text-small">(Max 100 rows of data)</span>
                        <br>
                        <br>

                    </div>
                    <button class="btn btn-info" style="margin-left: 43%"><i class="fe fe-upload mr-2"></i>Upload User Data</button>
                    {{--            <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>--}}
                </form>
            </div>

        </div>

</div>
@endsection
