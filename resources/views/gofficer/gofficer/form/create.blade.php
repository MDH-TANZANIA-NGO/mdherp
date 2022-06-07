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
                        {!! Form::select('g_scale', $g_scales, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('g_scale', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
       {{--         <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('regions', __("Region"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('region_id', $regions, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('region_id', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>--}}
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('district', __("District"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('district_id', $districts, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>


                <button type="submit" class="btn btn-primary" style="margin-left:40%;">Register</button>

            </div>
        </div>

        {!! Form::close() !!}


        <form action="{{ route('g_officer.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <br>
            <button class="btn btn-success">Import User Data</button>
{{--            <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>--}}
        </form>
    </div>
</div>
