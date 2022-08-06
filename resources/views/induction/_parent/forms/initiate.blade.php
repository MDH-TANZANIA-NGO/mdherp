@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">INDUCTION SCHEDULE </h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'induction_schedule.storeSchedule']) !!}
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">Job </label>
                            {!! Form::select('designation_id',$designations, null,['class' => 'form-control select2', 'placeholder'=>'Select','required']) !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">Start Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="start_date" placeholder="MM/DD/YYYY" type="date">
                            </div>
                            @error('start_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">End Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control" name="end_date" placeholder="MM/DD/YYYY" type="date">
                            </div>
                            @error('end_date')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary">Initiate</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
