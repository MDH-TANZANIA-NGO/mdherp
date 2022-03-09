<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        {!! Form::open(['route' => 'rate.store','class'=>'card']) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('amount', __("1 USD equals to"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::number('amount',old('amount'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('amount', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                <button type="submit" class="btn btn-success" style="margin-left:40%;">Update</button>
                    </div>
                </div>

            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
