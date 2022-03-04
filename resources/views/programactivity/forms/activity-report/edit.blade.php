
@extends('layouts.app')

@section('content')

    @include('programactivity.display.generalSumarry')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            {!! Form::open(['route' => ['programactivityreport.update',$program_activity_report],'class'=>'card']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('venue', __("Venue Name"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('venue', $program_activity_report->venue_name, ['class' => 'form-control', 'required']) !!}
                            {!! $errors->first('venue', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('background_info', __("Background Information"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('background_info',$program_activity_report->background_info,['class' => 'form-control','required']) !!}
                            {!! $errors->first('background_info', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('plan', __("What Was Planned?"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('plan',$program_activity_report->what_was_planned,['class' => 'form-control ','required']) !!}
                            {!! $errors->first('plan', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('objectives', __("Objectives"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('objectives',$program_activity_report->objectives,['class' => 'form-control ','required']) !!}
                            {!! $errors->first('objectives', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('methodology', __("Methodology"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('methodology',$program_activity_report->methodology,['class' => 'form-control','required']) !!}
                            {!! $errors->first('methodology', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('achievement', __("Achievements"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('achievement',$program_activity_report->achievement,['class' => 'form-control ','required']) !!}
                            {!! $errors->first('achievement', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('challenges', __("Challenges"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('challenges',$program_activity_report->challenges,['class' => 'form-control ','required']) !!}
                            {!! $errors->first('challenges', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('recommendations', __("Recommendation"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::textarea('recommendations',$program_activity_report->recommendations,['class' => 'form-control ','required']) !!}
                            {!! $errors->first('recommendations', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('report_type', __("Report Type"),['class'=>'form-label','required_asterik']) !!}

                            <select class="form-control" name="status">
                                <option value="progressive">Progressive</option>
                                <option value="final">Final</option>
                            </select>
                            {!! $errors->first('report_type', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>




                <button type="submit" class="btn btn-outline-info" style="margin-left:40%;">Submit Report</button>

            </div>
        </div>

        {!! Form::close() !!}
    </div>


@endsection
