<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        {!! Form::open(['route' => ['activity_report.store']]) !!}
        <div class="card-body">
            <div class="row">
                @if(!empty($inputs))
                <input type="number" value="{{$inputs['requisition_id']}}" name="requisition_id" hidden>
                <input type="date" value="{{$inputs['start_date']}}" name="start_date" hidden>
                <input type="date" value="{{$inputs['end_date']}}" name="end_date" hidden>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('report_type', __("Report Type"),['class'=>'form-label','required_asterik']) !!}

                        <select class="form-control" name="status" required>
                            <option value="0">Progressive</option>
                            <option value="1">Final</option>
                        </select>
                        {!! $errors->first('report_type', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('venue', __("Venue Name"),['class'=>'form-label','required_asterik','required']) !!}
                        {!! Form::text('venue', null, ['class' => 'form-control', 'required']) !!}
                        {!! $errors->first('venue', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::label('background_info', __("Report content"),['class'=>'form-label','required_asterik']) !!}
{{--                        {!! Form::textarea('background_info',null,['class' => 'summernotecontent','required']) !!}--}}
                        <textarea class="content richText-initial" name="content" style="display: none;" required></textarea>
                        {!! $errors->first('background_info', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>

{{--                <div class="col-md-6">--}}
{{--                    <div class="form-group">--}}
{{--                        {!! Form::label('plan', __("What Was Planned?"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                        {!! Form::textarea('plan',null,['class' => 'form-control summernotecontent ','required']) !!}--}}
{{--                        {!! $errors->first('plan', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
            <button type="submit" class="btn btn-outline-info"><i class="fa fa-paper-plane-o"></i> Submit for approval</button>










{{--            <button type="submit" class="btn btn-outline-info" style="margin-left:40%;"><i class="fa fa-save"></i> Save and continue</button>--}}

        </div>
    </div>

    {!! Form::close() !!}
</div>
