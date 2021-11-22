@extends('layouts.app')

@section('content')


						<!-- Row -->
						<div class="row">
							<div class="col-xl-3 col-lg-5 col-md-12">
								<div class="card ">
									<div class="card-body">
										<div class="inner-all">
											<ul class="list-unstyled">
												<li class="text-center border-bottom-0">
													<img data-no-retina="" class="img-circle img-responsive img-bordered-primary" src="mdh/images/users/user.png" >
												</li>
												<li class="text-center">
													<h4 class="text-capitalize mt-3 mb-0">{{{$user->full_name_formatted}}}</h4>
													<p class="text-muted text-capitalize">MDH Staff</p>
												</li>
												<li>
													<a href="" class="btn btn-primary text-center btn-block"><i class="fe fe-unlock mr-2"></i>Reset Password</a>
												</li>
												<li><br></li>
												<li>
                                                    <table class="table   table-striped  table-outline text-nowrap">

                                                        <tbody>
                                                            <tr><td>Active since:20-09-2021 </td></tr>
                                                            <tr><td>Last Update: 05-10-2021</td></tr>
                                                            <tr><td>Supervior: Isack Laizer</td></tr>
                                                        </tbody>
                                                    </table>
												</li>
											</ul>
										</div>
									</div>
								</div>

							</div>
							<div class="col-xl-9 col-lg-7 col-md-12">


								<div class="card">

                                        <div class="tab-menu-heading">
                                            <div class="tabs-menu ">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs">
                                                    <li class=""><a href="#tab1" class="active" data-toggle="tab">Details</a></li>
                                                    <li><a href="#tab2" data-toggle="tab">Supervision</a></li>
                                                    <li><a href="#tab3" data-toggle="tab">Workflow</a></li>
                                                    <li><a href="#tab4" data-toggle="tab">Permissions</a></li>
                                                    <li><a href="#tab5" data-toggle="tab">Audit</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active " id="tab1">
                                                    <form class="card">

                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        {!! Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::text('first_name',$user->first_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                                                                        {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
{{--                                                                <div class="col-sm-6 col-md-4">--}}
{{--                                                                    <div class="form-group">--}}
{{--                                                                        <label class="form-label">Middle Name</label>--}}
{{--                                                                        <input type="text" class="form-control" placeholder="Middle Name" >--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
                                                                <div class="col-sm-6 col-md-4">
                                                                    <div class="form-group">
                                                                        {!! Form::label('last_name', __("label.name.last"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::text('last_name',$user->last_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                                                                        {!! $errors->first('last_name', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        {!! Form::label('dob', __("label.dob"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::date('dob',$user->dob,['class' => 'form-control', 'placeholder' => '','required']) !!}
                                                                        {!! $errors->first('dob', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-md-4">
                                                                    <div class="form-group">
                                                                        {!! Form::label('email', __("label.email"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::email('email',$user->email,['class' => 'form-control', 'placeholder' => '','required']) !!}
                                                                        {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-md-4">
                                                                    <div class="form-group">
                                                                        {!! Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::text('phone',$user->phone,['class' => 'form-control', 'placeholder' => '','required']) !!}
                                                                        {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        {!! Form::label('gender', __("label.gender"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::select('gender', $gender, $user->gender_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                                                        {!! $errors->first('gender', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        {!! Form::label('marital', __("label.marital"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::select('marital', $marital, $user->marital_status_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                                                        {!! $errors->first('marital', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        {!! Form::label('designation', __("label.designation"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::select('designation', $designations, $user->designation_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                                                        {!! $errors->first('designation', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        {!! Form::label('region', __("label.region"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::select('region', $regions, $user->region_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                                                        {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
{{--                                                                <div class="col-md-4">--}}
{{--                                                                    <div class="form-group ">--}}
{{--                                                                        {!! Form::label('projects', __("label.project"),['class'=>'form-label','required_asterik']) !!}--}}
{{--                                                                        {!! Form::select('projects[]', [], null, ['class' =>'form-control select2 custom-select', 'aria-describedby' => '','multiple','disabled']) !!}--}}
{{--                                                                        {!! $errors->first('projects', '<span class="badge badge-danger">:message</span>') !!}--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class=" col-md-4">--}}
{{--                                                                    <div class="form-group">--}}
{{--                                                                        <label class="form-label">Postal Code</label>--}}
{{--                                                                        <input type="number" class="form-control" placeholder="ZIP Code">--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
                                                                <button type="submit" class="btn btn-primary" style="margin-left:40%;">Update Profile</button>

                                                            </div>
                                                        </div>

                                                    </form>

                                                </div>
                                                <div class="tab-pane  " id="tab2">


                                                    <div class="card-body">
                                                        <form action="">
                                                            <div class="form-group">
                                                                <label class="form-label">Select Employee</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="Search for...">
                                                                    <span class="input-group-append">
                                                                        <button class="btn btn-primary" type="button">Select!</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="table-responsive">
                                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="wd-15p">Fullname</th>
                                                                    <th class="wd-15p">Designation</th>
                                                                    <th class="wd-20p">Action</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Elinipendo Mziray</td>
                                                                    <td>IT CUM Software Developmer</td>
                                                                    <td><div class="btn-group align-top">
                                                                        <button class="btn btn-sm btn-outline-primary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                                        <button class="btn btn-sm btn-outline-primary badge" type="button"><i class="fa fa-trash"></i></button>
                                                                    </div></td>

                                                                <tr>
                                                                    <td>Elinipendo Mziray</td>
                                                                    <td>IT CUM Software Developmer</td>
                                                                    <td><div class="btn-group align-top">
                                                                        <button class="btn btn-sm btn-outline-primary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                                        <button class="btn btn-sm btn-outline-primary badge" type="button"><i class="fa fa-trash"></i></button>
                                                                    </div></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Elinipendo Mziray</td>
                                                                    <td>IT CUM Software Developmer</td>
                                                                    <td><div class="btn-group align-top">
                                                                        <button class="btn btn-sm btn-outline-primary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                                        <button class="btn btn-sm btn-outline-primary badge" type="button"><i class="fa fa-trash"></i></button>
                                                                    </div></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Elinipendo Mziray</td>
                                                                    <td>IT CUM Software Developmer</td>
                                                                    <td><div class="btn-group align-top">
                                                                        <button class="btn btn-sm btn-outline-primary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                                        <button class="btn btn-sm btn-outline-primary badge" type="button"><i class="fa fa-trash"></i></button>
                                                                    </div></td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                    <!-- table-wrapper -->
                                                    {{-- content to be displayed --}}



                                                </div>
                                                <div class="tab-pane " id="tab3">
                                              {{-- content to be displayed --}}
                                                    @include('system.workflow.definition_assignment',['user' => $user, 'wf_module_groups'])
                                                </div>
                                                <div class="tab-pane " id="tab4">
                                              {{-- content to be displayed --}}
                                                </div>
                                                <div class="tab-pane " id="tab5">
                                                    {{-- content to be displayed --}}
                                                    <div class="card-body">

                                                        <div class="table-responsive">
                                                            <table class="table card-table table-vcenter text-nowrap">
                                                            <thead>
                                                                <tr>
                                                                    <th class="wd-15p">Action</th>
                                                                    <th class="wd-15p">Date Perfomed</th>
                                                                    <th class="wd-20p">IP Address</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Create Requisition</td>
                                                                    <td>2018/03/12</td>
                                                                    <td>192.168.1.200</td>

                                                                <tr>
                                                                    <td>Approve Requisition</td>
                                                                    <td>2018/03/12</td>
                                                                    <td>192.168.1.200</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Apply Safari Advance</td>
                                                                    <td>2018/03/12</td>
                                                                    <td>192.168.1.200</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Submit LPO</td>
                                                                    <td>2018/03/12</td>
                                                                    <td>192.168.1.200</td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                    <!-- table-wrapper -->
                                                      </div>
                                            </div>
                                        </div>


								</div>
                            </div>
                        </div>

@endsection
