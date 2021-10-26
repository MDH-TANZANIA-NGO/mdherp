{!! Form::open(['route' => ['activity.update',$activity], 'method' => 'put',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-3">
                    {!! Form::label('sub_program', __("label.sub_program"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('sub_program', $sub_programs, $activity->sub_program_id,['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('sub_program', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-3">
                    {!! Form::label('code', __("label.code"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('code', $activity->code, ['class' => 'form-control', 'required']) !!}
                    {!! $errors->first('code', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-3">
                    {!! Form::label('title', __("label.title"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('title', $activity->title, ['class' => 'form-control', 'required']) !!}
                    {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-3">
                    {!! Form::label('output_unit', __("label.output_unit"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('output_unit', $output_unit, $activity->output_unit_id,['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('output_unit', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>

            <div class="row">
                <div class="col-12 mt-1">
                    {!! Form::label('description', __("label.description"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::textarea('description', $activity->description, ['class' => 'form-control', 'required','rows'=>2]) !!}
                    {!! $errors->first('description', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-azure" style="margin-top: 5px; margin-left: 10px">Update Activity </button>
            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}
