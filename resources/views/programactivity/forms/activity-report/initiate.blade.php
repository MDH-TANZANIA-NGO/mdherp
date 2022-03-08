
@extends('layouts.app')

@section('content')
    @if(access()->user()->assignedSupervisor())
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(238, 241, 248)">
                        <h3 class="card-title">Initiate Activity Report</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['programactivityreport.store']]) !!}
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('program_activity_id', __("Activity Number"),['class'=>'form-label','required_asterik']) !!}
                                        {!! Form::select('program_activity_id', $activities, null,['class' => 'form-control select2-show-search', 'required']) !!}
                                        {!! $errors->first('program_activity_id', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Initiate Activity</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    You Have no supervisor
    @endif

@endsection
