{!! Form::open(['route' => 'sub_program.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-3">
                    {!! Form::label('program_area', __("label.program_area"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('program_area', $program_areas, null,['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('program_area', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-9">
                    {!! Form::label('title', __("label.title"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'required','placeholder'=>'Enter Sub-program area title']) !!}
                    {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>

            &nbsp;

            <div class="row">
                <div class="col-12 mt-1">
                    {!! Form::label('description', __("label.description"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder'=>'Enter Descriptions','required','rows'=>2]) !!}
                    {!! $errors->first('description', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>

            &nbsp;

            <div class="row">

                <div class="col-12">
                <div style="text-align: center;">

                <button type="submit" class="btn btn-azure" >Create Sub-Program Area </button>

                </div>
                </div>
            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}
