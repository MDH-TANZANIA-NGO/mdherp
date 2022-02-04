@extends('layouts.app')

@section('content')

    <div class="col-lg-12 col-md-12">
        {!! Form::open(['route' => 'person.family.store', 'method' => 'post',]) !!}

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Register Family Member</span>
                </div>
            </div>

            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name"  required>
                            @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Gender</label>
                            {!! Form::select('gender_cv_id', $gender, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            @error('gender_cv_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('relationship_cv_id', "Relation",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('relationship_cv_id', $relations, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('relationship_cv_id', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone"  required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        {!! Form::label('dob', __("label.dob"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::date('dob',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('dob', '<span class="badge badge-danger">:message</span>') !!}
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-label">Is this person your next of kin?</div>
                        <div class="custom-controls-stacked">
                            <label class="custom-control  custom-radio">
                                <input type="radio" class="custom-control-input" name="is_next_of_kin" value=1>
                                <span class="custom-control-label">Yes</span>
                            </label>
                            <label class="custom-control  custom-radio">
                                <input type="radio" class="custom-control-input" name="is_next_of_kin" value=0>
                                <span class="custom-control-label">No</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                            <div class="form-label">Is this person your emergency contact?</div>
                            <div class="custom-controls-stacked">
                                <label class="custom-control  custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_emergency" value=1>
                                    <span class="custom-control-label">Yes</span>
                                </label>
                                <label class="custom-control  custom-radio">
                                    <input type="radio" class="custom-control-input" name="is_emergency" value=0>
                                    <span class="custom-control-label">No</span>
                                </label>
                            </div>
                        </div>
                </div>
                &nbsp

                <div class="row">

                    <div class="col-12">
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-azure"> Register</button>
                        </div>
                    </div>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection




