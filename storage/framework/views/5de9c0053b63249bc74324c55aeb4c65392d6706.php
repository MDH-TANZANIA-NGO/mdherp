<?php $__env->startSection('content'); ?>

    <div class="row mt-5">
        <div class="col-xl-12 col-lg-12 col-md-12"></div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <?php echo Form::open(['route' => 'user.store','class'=>'card']); ?>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('identity_no', __("Employee No"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::text('identity_number',old('identity_number'),['class' => 'form-control', 'placeholder' => 'ie. John']); ?>

                                <?php echo $errors->first('identity_number', '<span class="badge badge-danger">:message</span>'); ?>

                                <input type="date" value="null" name="employed_date" hidden>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::text('first_name',old('first_name'),['class' => 'form-control', 'placeholder' => 'ie. John','required']); ?>

                                <?php echo $errors->first('first_name', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('middle_name', __("label.name.middle"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::text('middle_name',old('middle_name'),['class' => 'form-control', 'placeholder' => 'ie. Someone','required']); ?>

                                <?php echo $errors->first('middle_name', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('last_name', __("label.name.last"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::text('last_name',old('last_name'),['class' => 'form-control', 'placeholder' => 'ie. Doe','required']); ?>

                                <?php echo $errors->first('last_name', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('dob', __("label.dob"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::date('dob',old('dob'),['class' => 'form-control', 'placeholder' => '','required', 'max'=>'2004-12-31']); ?>

                                <?php echo $errors->first('dob', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('email', __("label.email"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::email('email',old('email'),['class' => 'form-control', 'placeholder' => 'ie. initials@mdh.or.tz','required']); ?>

                                <?php echo $errors->first('email', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <?php echo Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::number('phone',old('phone'),['class' => 'form-control', 'placeholder' => 'ie. 0712311311','required']); ?>

                                <?php echo $errors->first('phone', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <?php echo Form::label('gender', __("label.gender"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::select('gender', $gender, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                                <?php echo $errors->first('gender', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <?php echo Form::label('marital', __("label.marital"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::select('marital', $marital, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                                <?php echo $errors->first('marital', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <?php echo Form::label('designation', __("label.designation"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::select('designation', $designations, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                                <?php echo $errors->first('designation', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <?php echo Form::label('region', __("label.region"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::select('region', $regions, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']); ?>

                                <?php echo $errors->first('region', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group ">
                                <?php echo Form::label('projects', __("label.project"),['class'=>'form-label','required_asterik']); ?>

                                <?php echo Form::select('projects[]', [], null, ['class' =>'form-control select2 custom-select', 'aria-describedby' => '','multiple','disabled']); ?>

                                <?php echo $errors->first('projects', '<span class="badge badge-danger">:message</span>'); ?>

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-left:40%;">Register</button>

                    </div>
                </div>

            <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/user/form/create.blade.php ENDPATH**/ ?>