
@extends('layouts.app')

@section('content')
    @if(access()->user()->assignedSupervisor())
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: rgb(238, 241, 248)">
                        <h3 class="card-title">Initiate Safari</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => ['programactivity.store']]) !!}
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('requisition_training_id', __("Requisition Number"),['class'=>'form-label','required_asterik']) !!}
                                        {!! Form::select('requisition_training_id', $trainings, null,['class' => 'form-control select2-show-search', 'required']) !!}
                                        {!! $errors->first('requisition_training_id', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Initiate Safari</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    You Have no supervisor
    @endif

@endsection



