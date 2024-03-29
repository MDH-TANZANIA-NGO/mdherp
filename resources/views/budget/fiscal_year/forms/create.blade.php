<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        {!! Form::open(['route' => 'fiscal_year.store','class'=>'card']) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('title', __("label.title"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('title',old('first_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('from_at', __("label.start_date"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::date('from_at',old('dob'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('from_at', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('to_at', __("label.end_date"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::date('to_at',old('dob'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('to_at', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="margin-left:40%;">Register</button>

            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
