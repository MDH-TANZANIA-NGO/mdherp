@extends('layouts.app')

@section('content')
    @if($job_details == null)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create job offer</h3>
                        <div class="card-options ">
                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="demo-accordion accordionjs m-0" data-active-index="false">

                            <!-- Section 1 -->
                            <li class="acc_section">
                                <div class="acc_head"><h3>Elinipendo Mziray: <b>ICT CUM Software Developer</b></h3></div>
                                <div class="acc_content" style="display: none;"><p>Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Fusce aliquet neque et accumsan fermentum. Aliquam lobortis neque in nulla  tempus, molestie fermentum purus euismod.</p></div>
                            </li>

                        </ul>
                        <br>
                        {!! Form::open(['route' => 'job_offer.store']) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Salary amount</label>
                                    <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-dollar-sign"></i>
												</span>
                                        <input type="text" class="form-control" name="salary" placeholder="Salary Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Date of arrival</label>
                                    <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-calendar"></i>
												</span>
                                        <input type="date" name="date_of_arrival" class="form-control" placeholder="Salary Amount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Other benefits</label>
                                    <input type="text" name="details" class="content">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-instagram"><i class="fa fa-arrow-circle-left mr-2"></i>Back</a>
                        <button type="submit" class="btn btn-vk"><i class="fa fa-paper-plane-o mr-2"></i>Send for approval</button>


                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
    @endif
@endsection
