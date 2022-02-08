@extends('layouts.app')
@section('content')
    {!! Form::open(['route' => ['experience.update', $experience], 'method' => 'put']) !!}
    <!-- Large Modal -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <div class="row text-center">
                        <span class="col-12 text-center font-weight-bold">Practical Experience</span>
                    </div>

                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" >
                            <label class="form-label">Organisation/Company Name</label>
                            <input class="form-control" name="organisation_name" value="{{ $experience->organisation_name }}" required></input>
                            @error('organisation_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-md-6" >
                            <label class="form-label">Position Held</label>
                            <input class="form-control" name="position" value="{{ $experience->position }}" required></input>
                            @error('position')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                    </div>
                    &nbsp;
                    <div class="row">
                        <div class="col-md-6" >
                            {!! Form::label('summary', "Summary of duties",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('summary', $experience->summary, ['class' => 'form-control', 'required','rows'=>'2']) !!}
                            {!! $errors->first('summary', '<span class="badge badge-danger">:message</span>') !!}
                        </div>

                        <div class="col-md-6" >
                            {!! Form::label('supervisor', "Supervisor",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('supervisor', $experience->supervisor, ['class' => 'form-control', 'required','rows'=>'2']) !!}
                            {!! $errors->first('supervisor', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    &nbsp;
                    <div class="row">
                        <div class="col-md-6" >
                            <label class="form-label">Start Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="start_year" value="{{ $experience->start_year }}" type="date">
                            </div>
                            @error('start_year')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                        <div class="col-md-6" >
                            <label class="form-label">End Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="end_year" value="{{ $experience->end_year }}" type="date">
                            </div>
                            @error('end_year')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                    </div>

                    &nbsp
                    &nbsp;
                    <div class="row">

                        <div class="col-12">
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-azure"> Update Practical Experience Details</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
