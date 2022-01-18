@extends('layouts.app')

@section('content')
    <!-- Row -->
    <div class="row">
        <div class="col-xl-12 col-lg-8 col-md-12">
            <div class="card">
               <div class="tab-menu-heading" style="background-color: rgb(238, 241, 248)">
                    <div class="tabs-menu ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#tab1" class="active" data-toggle="tab">Personal Details</a></li>
                            <li><a href="#tab3" data-toggle="tab">Education</a></li>
                            <li><a href="#tab4" data-toggle="tab">Experience</a></li>
                            <li><a href="#tab5" data-toggle="tab">Timesheet</a></li>
                            <li><a href="#tab5" data-toggle="tab">Leave</a></li>
                            <li><a href="#tab5" data-toggle="tab">Salary Slip</a></li>
                            <li><a href="#tab5" data-toggle="tab">Contributions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active " id="tab1">

                           {{ "The body will go here" }}

                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="card-body">
                                {{--                                                        <form action="">--}}
                                {!! Form::open(['method' => 'post']) !!}
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
                        </div>

                        <div class="tab-pane " id="tab3">
                            {{-- content to be displayed --}}
                        </div>
                        <div class="tab-pane " id="tab4">
                            {{-- content to be displayed --}}
                            <div class="card-body">
                                <div class="row" style="background-color: rgb(238, 241, 248)">
                                    <div class="col-sm-3" style="margin-top: 15px;">
                                        <h6>User Permissions</h6>
                                    </div>
                                </div>

                                &nbsp
                            </div>
                        </div>
                        <div class="tab-pane " id="tab5">
                            {{-- content to be displayed --}}
                            <div class="card-body">
                                @include('employee.leave.index')
                            </div>
                            <!-- table-wrapper -->
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
