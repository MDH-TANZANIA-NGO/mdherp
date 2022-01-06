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
													<img data-no-retina="" class="img-circle img-responsive img-bordered-primary" src="{{URL::asset('mdh/images/users/login.png')}}" >
												</li>
												<li class="text-center">
													<h4 class="text-capitalize mt-3 mb-0">{{{Auth::user()->full_name_formatted}}}</h4>
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
{{--                                            <div class="tab-content">--}}
                                                <div class="tab-pane active " id="tab1">
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
                                                                        <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                                            <option label="Choose one">
                                                                            </option>
                                                                            <option value="1">Female</option>
                                                                            <option value="2">Male</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        <label class="form-label">Marital Status</label>
                                                                        <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                                            <option label="Choose one">
                                                                            </option>
                                                                            <option value="1">Single</option>
                                                                            <option value="2">Married</option>
                                                                            <option value="3">Divorced</option>
                                                                            <option value="4">widowed</option>
                                                                            <option value="5">Separated</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        <label class="form-label">Departments</label>
                                                                        <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                                            <option label="Choose one">
                                                                            </option>
                                                                            <option value="2">Finance</option>
                                                                            <option value="1">Strategic Information</option>
                                                                            <option value="2">Finance</option>
                                                                            <option value="3">Human Resource</option>
                                                                            <option value="4">Administration</option>
                                                                            <option value="5">Grants</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        <label class="form-label">Designation</label>
                                                                        <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                                            <option label="Choose one">
                                                                            </option>
                                                                            <option value="1">Chuck Testa</option>
                                                                            <option value="2">Sage Cattabriga-Alosa</option>
                                                                            <option value="3">Nikola Tesla</option>
                                                                            <option value="4">Cattabriga-Alosa</option>
                                                                            <option value="5">Nikola Alosa</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group ">
                                                                        <label class="form-label">Working Station</label>
                                                                        <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                                            <option label="Choose one">
                                                                            </option>
                                                                            <option value="1">Chuck Testa</option>
                                                                            <option value="2">Sage Cattabriga-Alosa</option>
                                                                            <option value="3">Nikola Tesla</option>
                                                                            <option value="4">Cattabriga-Alosa</option>
                                                                            <option value="5">Nikola Alosa</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class=" col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="form-label">Postal Code</label>
                                                                        <input type="number" class="form-control" placeholder="ZIP Code">
                                                                    </div>
                                                                </div>
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
                                                     content to be displayed



                                                </div>
                                                <div class="tab-pane " id="tab3">
                                               content to be displayed
                                                </div>
                                                <div class="tab-pane " id="tab4">
                                               content to be displayed
                                                </div>
                                                <div class="tab-pane " id="tab5">
                                                     content to be displayed
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
