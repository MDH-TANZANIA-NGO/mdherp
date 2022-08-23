
@extends('layouts.app')
@section('content')
{!! Form::open(['route' => 'admin.register_owner','class'=>'card']) !!}
<div class="modal-body">

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('company_name', __("Company Name"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::text('company_name',$vendor->company_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('company_name', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('phone', __("Phone"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::text('phone',$vendor->phone,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('email', __("Email"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::email('email', $vendor->email, ['class' =>'form-control', 'placeholder' => 'company@gmail.com' , 'aria-describedby' => '']) !!}
                {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('tin', __("TIN #"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::text('tin', $vendor->tin, ['class' =>'form-control', 'placeholder' => 'TIN98298298298' , 'aria-describedby' => '']) !!}
                {!! $errors->first('tin', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('regions', __("Region"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::select('region_id', $regions, $vendor->region_id, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required', 'width'=>'100%']) !!}
                {!! $errors->first('region_id', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('address', __("Address"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::text('address', $vendor->address, ['class' =>'form-control', 'placeholder' => 'Address' , 'aria-describedby' => '']) !!}
                {!! $errors->first('address', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group ">
                {!! Form::label('services', __("Services offered"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::select('services[]', $services, $vendor_services, ['class' =>'form-control select2-show-search','multiple' , 'aria-describedby' => '', 'required', 'width'=>'100%']) !!}
                {!! $errors->first('services', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group ">
                {!! Form::label('remarks', __("Remarks"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::textarea('remarks', $vendor->content, ['class' =>'form-control', 'placeholder' => 'Remarks' , 'aria-describedby' => '']) !!}
                {!! $errors->first('remarks', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('first_name', __("Contact person firstname"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::text('first_name',$vendor->first_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('middle_name', __("Contact person middlename"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::text('middle_name',$vendor->middle_name,['class' => 'form-control', 'placeholder' => '']) !!}
                {!! $errors->first('middle_name', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('last_name', __("Contact person lastname"),['class'=>'form-label','required_asterik']) !!}
                {!! Form::text('last_name',$vendor->last_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                {!! $errors->first('last_name', '<span class="badge badge-danger">:message</span>') !!}
            </div>
        </div>
    </div>



</div>
<div class="modal-footer">
    <a  class="btn btn-secondary" href="{{route('admin.vendor')}}">Back</a>
    <button type="submit" class="btn btn-primary">Save changes</button>
</div>
{!! Form::close() !!}

@endsection
