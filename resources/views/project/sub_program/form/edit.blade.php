{!! Form::open(['route' => ['sub_program.update',$sub_program], 'method' => 'put',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">

        <div class="row">
            <span class="col-12 text-center font-weight-bold">PROGRAM AREA: {{ $sub_program->title }}</span>
            </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-3">
                    {!! Form::label('program_area', __("label.program_area"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('program_area', $program_areas, $sub_program->program_area_id,['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('program_area', '<span class="badge badge-danger">:message</span>') !!}
                </div>

                <div class="col-9">
                    {!! Form::label('title', __("label.title"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::text('title', $sub_program->title, ['class' => 'form-control', 'required']) !!}
                    {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>

            &nbsp;

            <div class="row">
                <div class="col-12 mt-1">
                    {!! Form::label('description', __("label.description"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::textarea('description', $sub_program->description, ['class' => 'form-control', 'required','rows'=>2]) !!}
                    {!! $errors->first('description', '<span class="badge badge-danger">:message</span>') !!}
                </div>
            </div>
            &nbsp;

            <div class="row">
            <div class="col-12">
                <div style="text-align: center;">


                <button type="submit" class="btn btn-azure" style="margin-top: 5px; margin-left: 10px">Update</button>
            </div>

                </div>
            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}


{!! Form::open(['route' => ['user.attach_sub_program',$sub_program], 'method' => 'post',]) !!}
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">

                <div class="row">
                    <span class="col-12 text-center font-weight-bold">User</span>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-12">
                    {!! Form::label('user', __("label.program_area"),['class'=>'form-label','required_asterik']) !!}
                    {!! Form::select('user', $users, $sub_program->users()->first() ? $sub_program->users()->first()->id : null,['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                    {!! $errors->first('user', '<span class="badge badge-danger">:message</span>') !!}
                </div>

            </div>

            &nbsp;
            <div class="row">
                <div class="col-12">
                    <div style="text-align: center;">


                        <button type="submit" class="btn btn-azure" style="margin-top: 5px; margin-left: 10px">Assign</button>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}

