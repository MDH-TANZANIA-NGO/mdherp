@extends('layouts.app')
@section('content')
    {!! Form::open(['route' => ['education.update', $education], 'enctype'=>"multipart/form-data", 'method' => 'put',]) !!}
    <!-- Large Modal -->
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <span class="col-12 text-center font-weight-bold">EDUCATION DETAILS</span>
                </div>

                &nbsp;

                <div class="row">

                    <div class="col-md-4">
                        {!! Form::label('level', "Education Level",['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('education_level_cv_id', $educations, $education->education_level_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('education_level_cv_id', '<span class="badge badge-danger">:message</span>') !!}
                    </div>

                    <div class="col-md-8">
                        {!! Form::label('institution_name', "Institution Name",['class'=>'form-label','required_asterik']) !!}
                        {!! Form::textarea('institution_name', $education->institution_name, ['class' => 'form-control', 'required', 'rows'=>'2']) !!}
                        {!! $errors->first('institution_name', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

                &nbsp;

                <div class="row">

                    <div class="col-md-8">
                        {!! Form::label('award_received', "Course",['class'=>'form-label','required_asterik']) !!}
                        {!! Form::textarea('award_received', $education->award_received, ['class' => 'form-control', 'required','rows'=>'2']) !!}
                        {!! $errors->first('award_received', '<span class="badge badge-danger">:message</span>') !!}
                    </div>


                    <div class="col-4">
                        <label class="form-label">Upload Certificate</label>
                        <input type="file" class="form-control" name="certificate"></input>
                        @error('certificate')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>

                &nbsp;

                <div class="row">
                    <div class="col-6">
                        {!! Form::label('start_year', __("label.start_year"),['class'=>'form-label','required_asterik']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                            </div><input class="form-control" value="{{ $education->start_year }}" name="end_year"  type="date" min="1997-01-01" required>
                        </div>
                        {!! $errors->first('start_year', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                    <div class="col-6">
                        {!! Form::label('end_year', __("label.end_year"),['class'=>'form-label','required_asterik']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                </div>
                            </div><input class="form-control" value="{{ $education->end_year }}" name="end_year"  type="date" min="1997-01-01" required>
                        </div>
                        {!! $errors->first('end_year', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

                &nbsp

                &nbsp;

                <div class="row">
                    <div class="col-12">
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-azure">Update Academic Details </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {!! Form::close() !!}

@endsection
