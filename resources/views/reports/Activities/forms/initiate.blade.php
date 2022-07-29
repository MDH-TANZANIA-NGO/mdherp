@extends('layouts.app')
@section('content')

    @if(access()->user()->assignedSupervisor())
        {!! Form::open(['route' => ['programactivity.store','method'=>'GET']]) !!}
        <div class="card-body">
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
{{--                        {!! Form::label('requisition_training_id', __("Requisition Number"),['class'=>'form-label','required_asterik']) !!}--}}
                        {!! Form::select('requisition_training_id', $trainings, null,['class' => 'form-control select2-show-search', 'required']) !!}
                        {!! $errors->first('requisition_training_id', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-outline-info" >Request Attendance</button>

                </div>


                {!! Form::close() !!}
            </div>
        </div>
        {!! Form::close() !!}

@include('reports.Activities.hotspots')
                @else
                    You Have no supervisor
    @endif

@endsection


