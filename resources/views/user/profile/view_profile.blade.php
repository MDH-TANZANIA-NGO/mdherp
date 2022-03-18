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
													<img data-no-retina="" class="img-circle img-responsive img-bordered-primary" src="{{URL::asset('mdh/images/users/login.png')}}" height="100" width="100" >
												</li>
												<li class="text-center">
													<h4 class="text-capitalize mt-3 mb-0">{{$user->full_name_formatted}}</h4>
													<p class="text-muted text-capitalize">MDH Staff</p>
												</li>
												<li>
													<a href="{{ route('user.password_reset',$user) }}" class="btn btn-primary text-center btn-block"><i class="fe fe-unlock mr-2"></i>Reset Password</a>
												</li>
												<li><br></li>

												<li>
                                                    <table class="table   table-striped  table-outline text-nowrap">

                                                        <tbody>
                                                            <tr><td>Active since:{{$user->created_at}} </td></tr>
                                                            <tr><td>Last Update: {{$user->updated_at}}</td></tr>
                                                            <tr><td>Supervior:  {{$supervisor}}
                                                                </td></tr>
                                                          {{--  <tr><td>
                                                                    Deactivate

                                                                    <div class="material-switch pull-right">
                                                                        <input id="someSwitchOptionDanger" name="active" value="false" type="checkbox" >
                                                                        <label for="someSwitchOptionDanger" class="label-danger" style="margin-top: 15px"></label>
                                                                    </div>



                                                                </td></tr>--}}
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

                                        <div class="tab-menu-heading" style="background-color: rgb(238, 241, 248)">
                                            <div class="tabs-menu ">
                                                <!-- Tabs -->
                                                <ul class="nav panel-tabs">
                                                    <li class=""><a href="#tab1" class="active" data-toggle="tab">Details</a></li>
                                                    @if($user->supervisor)<li><a href="#tab2" data-toggle="tab">Supervision</a></li>@endif
                                                    <li><a href="#tab3" data-toggle="tab">Workflow</a></li>
                                                    <li><a href="#tab4" data-toggle="tab">Permissions</a></li>
{{--                                                    <li><a href="#tab5" data-toggle="tab">Audit</a></li>--}}
                                                    <li><a href="#tab6" data-toggle="tab">Leave Setup</a></li>
                                                    <li><a href="#tab7" data-toggle="tab">Level of Effort</a></li>
                                                    <li><a href="#tab8" data-toggle="tab">Leave Balance</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="panel-body tabs-menu-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active " id="tab1">

                                                        {!! Form::open(['route' => ['user.update', $user],'method' => 'PUT','class' => 'card']) !!}
                                                        <div class="card-body">

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        {!! Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::text('first_name',$user->first_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                                                                        {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6 col-md-4">
                                                                    <div class="form-group">
                                                                        {!! Form::label('middle_name', __("label.name.middle"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::text('middle_name',$user->middle_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                                                                        {!! $errors->first('middle_name', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
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
                                                                        {!! Form::select('designation', $designations, $user->designation_id, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                                                        {!! $errors->first('designation', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        {!! Form::label('region', __("label.region"),['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::select('region', $regions, $user->region_id, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                                                                        {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        {!! Form::label('projects', __("label.project").'(s)',['class'=>'form-label','required_asterik']) !!}
                                                                        {!! Form::select('projects[]', $projects, $user_projects, ['class' =>'form-control select2-show-search', 'aria-describedby' => '','multiple']) !!}
                                                                        {!! $errors->first('projects', '<span class="badge badge-danger">:message</span>') !!}
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        <label class="form-label">Status</label>
                                                                       <select class="form-control" name="active">
                                                                           <option value="true">Activate</option>
                                                                           <option value="false">Deactivate</option>
                                                                       </select>
                                                                        </div>
                                                                </div>


                                                              {{--  <div class=" col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Is supervisor ?</label>
                                                                        <input type="checkbox" name="supervisor" {{ $user->supervisor ? 'checked' : ''}} class="form-control">
                                                                    </div>
                                                                </div>--}}
                                                                <div class=" col-md-4">
                                                                <div class="form-group">
                                                                    <label class="custom-switch">
                                                                        <input type="checkbox" name="supervisor" {{ $user->supervisor ? 'checked' : ''}} class="custom-switch-input" >
                                                                        <span class="custom-switch-indicator"></span>
                                                                        <span class="custom-switch-description">Is Supervisor
                                                                    </span>
                                                                    </label>
                                                                </div>
                                                                </div>
{{--                                                                <button type="submit" class="btn btn-primary" style="margin-left:40%;">Update Profile</button>--}}
                                                                {!! Form::submit('Update Profile',['class' => 'btn btn-primary']) !!}

                                                            </div>
                                                        </div>
                                                        {!! Form::close() !!}

                                                </div>
                                                <div class="tab-pane" id="tab2">
                                                    <div class="card-body">
{{--                                                        <form action="">--}}
                                                        {!! Form::open(['route' => ['user.assign_supervisor', $user->id],'method' => 'post']) !!}
                                                            <div class="form-group">
                                                                <label class="form-label">Select Employee</label>
                                                                <div class="input-group">
{{--                                                                    <input type="text" class="form-control" placeholder="Search for...">--}}
                                                                    {!! Form::select('users[]',$users,null,['class' => 'form-control select2-show-search', 'multiple','style'=>'width: 100%']) !!}

                                                                </div>
                                                                &nbsp;
                                                                <div class="input-group text-center" style="margin-left: 500px">


                                                                        <button class="btn btn-primary" type="submit">Select!</button>

                                                                </div>

                                                            </div>


                                                        {!! Form::close() !!}

                                                        <hr>
{{--                                                        </form>--}}
                                                        <div class="table-responsive">
                                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th class="wd-15p">Fullname</th>
                                                                    <th class="wd-20p">Action</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                               @foreach( $user_with_supervisor AS $supervised)
                                                                   <tr>
                                                                       <td>{{$supervised->names}}</td>
                                                                       <td><a href="{{ route('user.remove_supervisor', $supervised->user_id)}}" onclick="return confirm('are you sure?')"><button class="form-control btn-danger">Remove</button></a></td>
                                                                   </tr>
                                                               @endforeach
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
                                            <div class="card-body">
                                                    {!! Form::open(['route' => ['user.permission_update', $user]]) !!}

                                                <div class="row" style="background-color: rgb(238, 241, 248)">
                                                    <div class="col-sm-3" style="margin-top: 15px;">
                                                        <h6>User Permissions</h6>
                                                    </div>
                                                </div>

                                                &nbsp;

                                                    <div class="row">
                                                        @foreach($permissions as $key => $permission)
                                                            <div class="col-sm-4">
                                                                <!-- checkbox -->
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-secondary d-inline">
                                                                        <input name="permissions[]" type="checkbox" id="permission_{{ $permission->id }}" value="{{
                                            $permission->id }}" name="definitions[]"
                                                                            {{ $user->checkPermission($permission->id) ? 'checked' : '' }}>
                                                                        <label for="permission_{{ $permission->id }}" title="{{$permission->description}}">
                                                                            {{ $key + 1 }} . {{ $permission->display_name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <!-- checkbox -->
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <div class="row">
                                                         {!! Form::submit('Attach Permission',['class'=>'btn btn-primary']) !!}
                                                    </div>

                                                    {!! Form::close() !!}
                                            </div>
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

                                                <div class="tab-pane " id="tab6">

                                                    {!! Form::open(['route' => ['leave.setup'],'method' => 'POST']) !!}

                                                    <ul class="list-group">

                                                        @foreach($leave_types AS $key => $leave_type)
                                                        <input type="number" value="{{$user->id}}" name="data[{{$key}}][user_id]" hidden >
                                                        <li class="list-group-item justify-content-between">

                                                            {{$leave_type->name}}<input type="number" value="{{$leave_type->id}}" name="data[{{$key}}][leave_id]" hidden>
                                                            <span class="badgetext badge  badge-pill"><input type="number" value="{{$leave_type->days}}" name="data[{{$key}}][remaining_days]" class="form-control"></span>
                                                        </li>

                                                        @endforeach



                                                    </ul>
                                                    <button class="btn btn-outline-primary" type="submit" style="margin-left: 40%; margin-top: 2%">Submit</button>
                                                    {!! Form::close() !!}


                                                </div>

                                                <div class="tab-pane " id="tab7">
                                                        {!! Form::open(['route' => ['timesheet.setup'],'method' => 'POST']) !!}
                                                        <ul class="list-group">
                                                            @foreach($user_projects AS $key => $project)
                                                                <input type="number" value="{{$user->id}}" name="data[{{$key}}][user_id]" hidden >
                                                                <li class="list-group-item justify-content-between">
                                                                    {{$project->title}}<input type="number" value="{{$project->id}}" name="data[{{$key}}][project_id]" hidden>
                                                                    <span class="badgetext badge  badge-pill"><input type="number"  name="data[{{$key}}][percentage]" class="form-control"></span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <button class="btn btn-outline-primary" type="submit" style="margin-left: 40%; margin-top: 2%">Submit</button>
                                                        {!! Form::close() !!}
                                                </div>

                                                <div class="tab-pane " id="tab8">
                                                    <div class="emp-tab">
                                                        <div class="table-responsive">
                                                            <table class="table  table-hover table-striped">
                                                                <thead class="text-primary">
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Leave Type</th>
                                                                    <th>Remaining Days</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                {!! Form::open(['route' => ['timesheet.setup'],'method' => 'POST']) !!}
                                                               @if($leave_balances == NULL)

                                                                       <tr>
                                                                           <td>This user has no leave balances</td>
                                                                       </tr>

                                                               @else
                                                                   @foreach($leave_balances as $leave_balance)
                                                                       <tr>
                                                                           <td>{{$leave_balance->id}}</td>
                                                                           <td>{{$leave_balance->leaveType->name}}</td>
                                                                           <td>{{$leave_balance->remaining_days}}</td>
                                                                       </tr>
                                                                   @endforeach
                                                               @endif
                                                                {!! Form::close() !!}
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>


								</div>
                            </div>
                        </div>

@endsection

{{--<div class="form-group">--}}
{{--    <select name="scales[]" class="rates_list" multiple="multiple">--}}

{{--    </select>--}}
{{--</div>--}}
