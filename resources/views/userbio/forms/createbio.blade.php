@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-xl-3 col-lg-5 col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-center border-bottom-0">



                                {!! Form::open(['route' => ['userbio.uploadpic', access()->user()->uuid], 'method' => 'post', 'enctype'=>'multipart/form-data']) !!}

                                    <input type="file" name="profile_pic" class="dropify" data-default-file="" data-height="180"  />


                            </li>
                            <li class="text-center">
                                <h4 class="text-capitalize mt-3 mb-0">{{access()->user()->full_name_formatted}}</h4>
                                <p class="text-muted text-capitalize">{{access()->user()->designation->unit->name.' '. access()->user()->designation->name}} </p>
                                <p class="text-muted text-capitalize">Reporting to: {{$supervisor}}</p>
                            </li>

                            <li><br></li>
                            <li>
                                <div class="btn-group-vertical btn-block border-top-0">
                                    <button type="submit" class="btn btn-outline-primary"><i class="fe fe-upload mr-2"></i>Upload Photo</button>

                                    {!! Form::close() !!}

{{--                                    <a href="" class="btn btn-primary"><i class="fe fe-settings mr-2"></i>Edit Account</a>--}}
{{--                                    <a href="" class="btn btn-outline-primary"><i class="fe fe-alert-circle mr-2"></i>Logout</a>--}}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-9 col-lg-7 col-md-12">


            <div class="row">
                <div class="col-md-12">

                    {!! Form::open(['route' => ['userbio.update'], 'method' => 'put']) !!}
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class=" " id="profile-log-switch">
                                <div class="fade show active ">

                                    <div class="form-group">
                                    <div class="row mt-5 profie-img">

                                        <div class="col-md-12">

                                                <label class="form-label">Biography: <span class="form-label-small">56/100</span></label>
                                                <textarea class="form-control" name="bio" rows="2" placeholder="Please enter your Biography" required>{{$userbio->bio?? $userbio}}</textarea>
                                            </div>
                                        </div>

                                        &nbsp;
                                        <div class="col-12">
                                            <div style="text-align: center;">
                                                <button type="submit" class="btn btn-azure"> Update Bio </button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
