@extends('layouts.app')
@section('content')
<div class="card-body">
    <div class="text-wrap">
        <div class="example">
            <div class="tags">

                <div class="tag">
                    Available Fund
                    <span class="tag-addon tag-success">
                        @if($requisition->fundChecker == null)
                            {{number_2_format($requisition->budget->actual_amount)}}
                        @else
                            {{number_2_format($requisition->fundChecker->actual_amount)}}
                        @endif
                    </span>
                </div>
                <span class="tag tag-dark">
														Total amount requested
														<span class="tag-addon tag-warning">{{number_2_format($requisition->amount)}}</span>
													</span>
            </div>
        </div>
    </div>
</div>

{!! Form::open(['class'=>'card']) !!}

<div class="card-body">
    <div class="row">



        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('from', __("From Date"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::date('from',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('to', __("To Date"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::date('to',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group">
                {!! Form::label('destination', __("Destination District"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::select('district_id',$districts,null,['class' => 'form-control select2-show-search','placeholder'=>'Select District','required']) !!}
                {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('accommodation', __("Accommodation per night"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('accommodation',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('accommodation', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('transportation', __("Ground Transport"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('transportation',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('transportation', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('ticket_fair', __("Ticket Fair"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('ticket_fair',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('ticket_fair', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('other_cost', __("Other Cost"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::number('other_cost',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('other_cost', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('other_cost_description', __("Other Cost Description"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::text('other_cost_description',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('other_cost_description', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>

        <button type="submit" class="btn btn-outline-info" style="margin-left:40%;"><i class="fa fa-bus"></i> Add Trip</button>



    {!! Form::close() !!}


@endsection
