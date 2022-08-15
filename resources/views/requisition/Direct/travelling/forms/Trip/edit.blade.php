
@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="tags">

            <div class="tag">
                Traveller's name
                <span class="tag-addon tag-success">{{$travelling_cost->user->first_name}} {{$travelling_cost->user->last_name}}</span>
            </div>
            <div class="tag tag-default" data-toggle="modal" data-target="#exampleModal">
                {{$travelling_cost->from}}
                <span class="tag-addon"><i class="fe fe-calendar"></i></span>
            </div>
            <div class="tag tag-default" data-toggle="modal" data-target="#exampleModal">
                {{$travelling_cost->to}}
                <span class="tag-addon"><i class="fe fe-calendar"></i></span>
            </div>

            <span class="tag tag-dark">
														Available days
														<span class="tag-addon tag-warning">{{$available_days}}</span>
													</span>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Traveller Date Range</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => ['travelling.update_date_range', $travelling_cost->uuid]]) !!}

                {!! Form::label('from', __("From Date"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::date('from',$travelling_cost->from,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}

                {!! Form::label('to', __("To Date"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::date('to',$travelling_cost->to,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}

            </div>
            <div class="modal-footer">


                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

{!! Form::open(['route' => ['trip.update',$trip_details->uuid],'class'=>'card']) !!}

<div class="card-body">
    <div class="row">



        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('from', __("From Date"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::date('from',$trip_details->from,['class' => 'form-control', 'placeholder' => '','min'=>$travelling_cost->from, 'max'=>$travelling_cost->to, 'required']) !!}
                {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('to', __("To Date"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::date('to',$trip_details->to,['class' => 'form-control', 'placeholder' => '','min'=>$travelling_cost->from, 'max'=>$travelling_cost->to, 'required']) !!}
                {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">

                {!! Form::label('destination', __("Destination District"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::select('district_id',$districts,$trip_details->district_id,['class' => 'form-control select2-show-search','placeholder'=>'Select District','required']) !!}
                {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('accommodation', __("Accommodation per night"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('accommodation',$trip_details->accommodation,['class' => 'form-control', 'placeholder' => '']) !!}
                {!! $errors->first('accommodation', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('transportation', __("Ground Transport"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('transportation',$trip_details->transportation,['class' => 'form-control', 'placeholder' => '']) !!}
                {!! $errors->first('transportation', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ticket_fair', __("Ticket Fair"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('ticket_fair',$trip_details->ticket_fair,['class' => 'form-control', 'placeholder' => '']) !!}
                {!! $errors->first('ticket_fair', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('other_cost', __("Other Cost"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('other_cost',$trip_details->other_cost,['class' => 'form-control', 'placeholder' => '']) !!}
                {!! $errors->first('other_cost', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('other_cost_description', __("Other Cost Description"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::text('other_cost_description',$trip_details->other_cost_description,['class' => 'form-control', 'placeholder' => '']) !!}
                {!! $errors->first('other_cost_description', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>

        <input type="number" name="traveller_uid" value="{{$travelling_cost->traveller_uid}}" hidden  >
        <input type="number" name="requisition_travelling_cost_id" value="{{$travelling_cost->id}}" hidden>
        <input type="text" name="travelling_cost_uuid" value="{{$travelling_cost->uuid}}" hidden>
        <button type="submit" class="btn btn-outline-info" style="margin-left:40%;"><i class="fa fa-bus"></i> Update</button>
        <a href="{{route('trip.create', $travelling_cost->uuid)}}" class="btn btn-outline-default" style="margin-left:2%;"><i class="fa fa-arrow-circle-left"></i> Back</a>
    </div>
</div>

{!! Form::close() !!}

@endsection
