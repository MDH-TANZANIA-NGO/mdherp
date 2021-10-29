@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            {!! Form::open(['route' => ['fiscal_year.update',$fiscal_year],'method' => 'put','class'=>'card']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('title', __("label.title"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('title',$fiscal_year->title,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('from_at', __("label.start_date"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::date('from_at',$fiscal_year->from_at,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('from_at', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('to_at', __("label.end_date"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::date('to_at',$fiscal_year->to_at,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('to_at', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('active', __("label.status"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('active', true_false_pluck(), $fiscal_year->active,['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('active', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="margin-left:40%;">Register</button>

                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
