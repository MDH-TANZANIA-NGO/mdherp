
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        {!! Form::open(['route' => ['travelling.update',$traveller],'class'=>'card']) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('traveller_name', __("Traveller Name"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('name',$traveller->user->full_name_formatted, ['class' => 'form-control', 'disabled']) !!}
                        {!! Form::number('traveller_uid',$traveller->traveller_uid, ['class' => 'form-control', 'hidden']) !!}
                        {!! $errors->first('traveller_uid', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('destination', __("Destination"),['class'=>'form-label','required_asterik']) !!}

                        {!! Form::select('district_id',$districts,$traveller->district_id,['class' => 'form-control select2-show-search','required']) !!}
                        {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                {{--                <div class="col-sm-6 col-md-4">--}}
                {{--                    <div class="form-group">--}}
                {{--                        {!! Form::label('perdiem_rate', __("Perdiem Rate"),['class'=>'form-label','required_asterik']) !!}--}}
                {{--                        {!! Form::select('perdiem_rate_id',$mdh_rates, null,['class' => 'form-control select2-show-search', 'required']) !!}--}}
                {{--                        {!! $errors->first('perdiem_rate_id', '<span class="badge badge-danger">:message</span>') !!}--}}
                {{--                    </div>--}}
                {{--                </div>--}}



                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('accommodation', __("Accommodation"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::number('accommodation',$traveller->accommodation/$traveller->no_days,['class' => 'form-control', 'placeholder' => 'ie. 100,000','required']) !!}
                        {!! $errors->first('accommodation', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('transportation', __("Transportation"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::number('transportation',$traveller->transportation,['class' => 'form-control', 'placeholder' => 'ie. 100,000','required']) !!}
                        {!! $errors->first('transportation', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-3 col-md-2">
                    <div class="form-group">
                        {!! Form::label('ticket_fair', __("Ticket Fair"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::number('ticket_fair',$traveller->ticket_fair,['class' => 'form-control', 'placeholder' => 'ie. 100,000']) !!}
                        {!! $errors->first('ticket_fair', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-3 col-md-2">
                    <div class="form-group">
                        {!! Form::label('other_cost', __("Other Costs"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::number('other_cost',$traveller->other_cost,['class' => 'form-control', 'placeholder' => 'ie. 100,000']) !!}
                        {!! $errors->first('other_cost', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('other_cost_description', __("Other Costs Description"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('other_cost_description',$traveller->others_description,['class' => 'form-control', 'placeholder' => 'Other Cost Description']) !!}
                        {!! $errors->first('other_cost_description', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('from', __("From Date"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::date('from',$traveller->from,['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('from', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('to', __("To Date"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::date('to',$traveller->to,['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('to', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Update Traveller</button>

            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>




    @endsection


