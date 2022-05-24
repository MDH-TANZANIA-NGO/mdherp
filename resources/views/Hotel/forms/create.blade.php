@extends('layouts.app')
@section('content')


    <div class="row  mb-3">
        <span class="col-12 text-left font-weight-bold">Register Vendor</span>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            {!! Form::open(['route' => 'admin.store','class'=>'card']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('name', __("Hotel Name"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('name',old('name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('name', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('district', __("District Located"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('district_id', $districts, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('remarks', __("Remarks"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('remarks',old('remarks'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('remarks', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>


                    <button type="submit" class="btn btn-info" style="margin-left:45%;"><i class="fa fa-paper-plane mr-2"></i>Submit</button>

                </div>
            </div>

            {!! Form::close() !!}

        </div>


    </div>
@endsection

