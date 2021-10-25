@extends('layouts.app')
@section('content')

    <div class="row mt-5">
        <div class="col-xl-12 col-lg-12 col-md-12"></div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <form class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control"  placeholder="First Name" >
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" placeholder="Middle Name" >
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <input type="email" class="form-control" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control"  placeholder="Date of Birth" >
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Email" >
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <input type="number" class="form-control" placeholder="i.e 0689000333">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Gender</label>
{{--                                <select class="form-control select2 custom-select" data-placeholder="Choose one">--}}
{{--                                    <option label="Choose one">--}}
{{--                                    </option>--}}
{{--                                    <option value="1">Female</option>--}}
{{--                                    <option value="2">Male</option>--}}
{{--                                </select>--}}

                                {!! Form::select('gender', $gender, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Marital Status</label>
                                {!! Form::select('marital', $marital, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Designation</label>
                                {!! Form::select('designation', $designations, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Region</label>
                                {!! Form::select('region', $regions, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            </div>
                        </div>
                        <div class=" col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Project(s)</label>
                                {!! Form::select('project', [], null, ['class' =>'form-control select2 custom-select', 'aria-describedby' => '','multiple','disabled']) !!}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-left:40%;">Register</button>

                    </div>
                </div>

            </form>
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
