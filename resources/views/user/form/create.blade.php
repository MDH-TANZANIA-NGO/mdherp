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
                                {!! Form::label('identity_no', __("Employee No"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::text('identity_number',old('identity_number'),['class' => 'form-control', 'placeholder' => 'ie. John']) !!}
                                {!! $errors->first('identity_number', '<span class="badge badge-danger">:message</span>') !!}
                                <input type="date" value="null" name="employed_date" hidden>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::text('first_name',old('first_name'),['class' => 'form-control', 'placeholder' => 'ie. John','required']) !!}
                                {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {!! Form::label('middle_name', __("label.name.middle"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::text('middle_name',old('middle_name'),['class' => 'form-control', 'placeholder' => 'ie. Someone','required']) !!}
                                {!! $errors->first('middle_name', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {!! Form::label('last_name', __("label.name.last"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::text('last_name',old('last_name'),['class' => 'form-control', 'placeholder' => 'ie. Doe','required']) !!}
                                {!! $errors->first('last_name', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('dob', __("label.dob"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::date('dob',old('dob'),['class' => 'form-control', 'placeholder' => '','required', 'max'=>'2004-12-31']) !!}
                                {!! $errors->first('dob', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {!! Form::label('email', __("label.email"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::email('email',old('email'),['class' => 'form-control', 'placeholder' => 'ie. initials@mdh.or.tz','required']) !!}
                                {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                {!! Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::number('phone',old('phone'),['class' => 'form-control', 'placeholder' => 'ie. 0712311311','required']) !!}
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
                                {!! Form::select('designation', $designations, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                {!! $errors->first('designation', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                {!! Form::label('region', __("label.region"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::select('region', $regions, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group ">
                                {!! Form::label('projects', __("label.project"),['class'=>'form-label','required_asterik']) !!}
                                {!! Form::select('projects[]', [], null, ['class' =>'form-control select2 custom-select', 'aria-describedby' => '','multiple','disabled']) !!}
                                {!! $errors->first('projects', '<span class="badge badge-danger">:message</span>') !!}
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
            let $project_select = $("select[name='projects[]']");
            let $sub_program_select = $("select[name='sub_program']");
            let $projects = [];

            $region_select.change(function (event){
                event.preventDefault();
                fetch_projects($(this).val());
            });

            function fetch_projects(region_id){
                let $url = base_url+'/projects/'+region_id+'/region';
                $.get($url, { region_id: region_id},
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
