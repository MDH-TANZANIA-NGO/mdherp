@extends('layouts.app')

@section('content')




    <div class="col-lg-12 col-md-12">
        {!! Form::open(['route' => 'person.address.store', 'method' => 'post',]) !!}

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Register Address</span>
                </div>
            </div>

            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Address Type</label>
                            {!! Form::select('address_type_cv_id', $types, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            @error('address_type_cv_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('district_id', __("label.district"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('district_id', $districts, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Area Name</label>
                            <input type="text" class="form-control" name="area_name"  required>
                            @error('area_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">House Number</label>
                            <input type="text" class="form-control" name="house_number"  required>
                            @error('house_number')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>
                </div>
                &nbsp

                <div class="row">

                    <div class="col-12">
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-azure"> Register Address </button>
                        </div>
                    </div>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection




