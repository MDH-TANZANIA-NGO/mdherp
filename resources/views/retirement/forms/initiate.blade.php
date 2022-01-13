
@extends('layouts.app')

@section('content')
    @if(access()->user()->assignedSupervisor())
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <h3 class="card-title">Initiate Retirement</h3>
                </div>
                <div class="card-body">






{{--                    {!! Form::open(['route' => ['retirement.create']]) !!}--}}
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('safari_advance_id', __("Safari Number"),['class'=>'form-label','required_asterik']) !!}
                                    {!! Form::select('safari_advance_id', $safaries, null,['class' => 'form-control select2-show-search', 'required']) !!}
                                    {!! $errors->first('safari_advance_id', '<span class="badge badge-danger">:message</span>') !!}

                                </div>
                            </div>


                            <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Initiate Retirement</button>

                </div>
            </div>
{{--                    {!! Form::close() !!}--}}

        </div>
    </div>
    @else
                <div class="card-body p-6">
                    <div class="panel panel-primary">
                        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
                            <div class="tab-content">


                                    <div class="card-body">
                                        <div class="align-content-center text-center">
                    You have not been assigned a supervisor in the system, Kindly contact IT personnel to assist you with that
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @endif

@endsection



