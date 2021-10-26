@extends('layouts.app')
@section('content')

    <div class="row mt-5">
        <div class="col-xl-12 col-lg-12 col-md-12"></div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            {!! Form::open(['route' => 'user.store','class'=>'card']) !!}
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('first_name', __("label.first_name"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::text('first_name',old('first_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                                {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {!! Form::label('middle_name', __("label.middle_name"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::text('middle_name',old('middle_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                                {!! $errors->first('middle_name', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {!! Form::label('last_name', __("label.last_name"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::text('last_name',old('last_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                                {!! $errors->first('last_name', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('dob', __("label.dob"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::date('dob',old('dob'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                                {!! $errors->first('dob', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {!! Form::label('email', __("label.email"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::email('email',old('email'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                                {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {!! Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::text('phone',old('phone'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                                {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                {!! Form::label('gender', __("label.gender"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::select('gender', $gender, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                {!! $errors->first('gender', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                {!! Form::label('marital', __("label.marital"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::select('marital', $marital, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                {!! $errors->first('marital', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                {!! Form::label('designation', __("label.designation"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::select('designation', $designations, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                {!! $errors->first('designation', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                {!! Form::label('region', __("label.region"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::select('region', $regions, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group ">
                                {!! Form::label('project', __("label.project"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::select('project', [], null, ['class' =>'form-control select2 custom-select', 'aria-describedby' => '','multiple','disabled']) !!}
                                {!! $errors->first('project', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-left:40%;">Register</button>

                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@push('after-scripts')
    <script>
        $(document).ready(function (){
            let $region_select = $("select[name='region']");
            let $project_select = $("select[name='project']");
            let $sub_program_select = $("select[name='sub_program']");
            let $projects = [];

            $region_select.change(function (event){
                event.preventDefault();
                fetch_projects($(this).val());
            });

            function fetch_projects(region_id){
                $.get("{{ route('project.by_region') }}", { region_id: region_id},
                    function(data, status){
                        if(data.length > 0){

                            $project_select.find('option').remove();
                            $.each(data, function(key, result) {
                                $projects.push(result.id);
                                let $option = "<option value='"+result.id+"'>"+result.title+"</option>";
                                $project_select.append($option);
                            });
                            $project_select.attr('disabled',false);
                            $project_select.attr('required',true);
                            $sub_program_select.attr('disabled',false);
                            /*call sub program function*/
                            // fetch_sub_program()
                        }else{
                            $project_select.find('option').remove();
                            $project_select.attr('disabled',true);
                            $project_select.attr('required',false);
                            $sub_program_select.attr('disabled',true);
                        }
                    });
            }

        });
    </script>
@endpush
