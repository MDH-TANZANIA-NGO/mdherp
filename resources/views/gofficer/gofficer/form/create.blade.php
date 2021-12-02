<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        {!! Form::open(['route' => 'g_officer.store','class'=>'card']) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('first_name',old('first_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('last_name', __("label.name.last"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('last_name',old('last_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('last_name', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('email', __("label.email"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::email('email',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('phone',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('g_scale', __("Title"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('g_scale', $g_scales, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('g_scale', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-left:40%;">Register</button>

            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
