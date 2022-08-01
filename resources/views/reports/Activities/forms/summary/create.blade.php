<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        {!! Form::open(['route' => ['safari.store']]) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('report_type', __("Report Type"),['class'=>'form-label','required_asterik']) !!}

                        <select class="form-control" name="status">
                            <option value="progressive">Progressive</option>
                            <option value="final">Final</option>
                        </select>
                        {!! $errors->first('report_type', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('venue', __("Venue Name"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('venue', null, ['class' => 'form-control', 'required']) !!}
                        {!! $errors->first('venue', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('background_info', __("Background Information"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::textarea('background_info',null,['class' => 'form-control summernotecontent','required']) !!}
                        {!! $errors->first('background_info', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('plan', __("What Was Planned?"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::textarea('plan',null,['class' => 'form-control summernotecontent ','required']) !!}
                        {!! $errors->first('plan', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('objectives', __("Objectives"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::textarea('objectives',null,['class' => 'form-control summernotecontent','required']) !!}
                        {!! $errors->first('objectives', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('methodology', __("Methodology"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::textarea('methodology',null,['class' => 'form-control summernotecontent','required']) !!}
                        {!! $errors->first('methodology', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

            </div>






            <div class="row"> <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('achievement', __("Achievements"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::textarea('achievement',null,['class' => 'form-control summernotecontent ','required']) !!}
                        {!! $errors->first('achievement', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('challenges', __("Challenges"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::textarea('challenges',null,['class' => 'form-control summernotecontent ','required']) !!}
                        {!! $errors->first('challenges', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('recommendations', __("Recommendation"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::textarea('recommendations',null,['class' => 'form-control  summernotecontent','required']) !!}
                        {!! $errors->first('recommendations', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
            </div>




            <button type="submit" class="btn btn-outline-info" style="margin-left:40%;"><i class="fa fa-save"></i> Save and continue</button>

        </div>
    </div>

    {!! Form::close() !!}
</div>
