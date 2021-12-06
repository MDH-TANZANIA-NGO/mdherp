{!! Form::open(['route' => 'activity.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">

        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Register Activity</span>
            </div>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            </div>

        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-4">
                    {!! Form::label('sub_program', __("label.sub_program"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('sub_program', $program_areas, null,['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('sub_program', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-4">
                    {!! Form::label('code', __("label.code"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('code', null, ['class' => 'form-control','placeholder' =>'Enter Activites Code','required']) !!}
                    {!! $errors->first('code', '<span class="badge badge-danger">:message</span>') !!}
                </div>


                <div class="col-4">
                    {!! Form::label('output_unit', __("label.output_unit"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('output_unit', $output_unit, null,['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('output_unit', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>
            &nbsp;
            <div class="row">

                <div class="col-12">
                    {!! Form::label('title', __("label.title"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control','placeholder' =>'Enter Activity Title', 'required']) !!}
                    {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>

            &nbsp;

            <div class="row">
                <div class="col-12 mt-1">
                    {!! Form::label('description', __("label.description"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control','placeholder' =>'Enter Activity Decriptions', 'required','rows'=>2]) !!}
                    {!! $errors->first('description', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>

            &nbsp;

            <div class="row">
                <div class="col-12">
                    <div style="text-align: center;">
                <button type="submit" class="btn btn-azure">Create Activity </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}
