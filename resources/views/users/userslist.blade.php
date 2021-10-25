@extends('layouts.app')

@section('content')

    <!-- Row -->
    <div class="row">
        <div class="col-xl-3 col-lg-5 col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="inner-all">
                        <form>
                            <ul class="list-unstyled">
                                <label>Workflow</label>
                                <li class="text-center">

                                <select class="form-control">

                                    <option>Select workflow</option>
                                    <option>Procurement Workflow</option>
                                    <option>Direct Workflow</option>
                                    <option>Utility Workflow</option>
                                </select>
                                </li>
                                <br>
                                <label>Project</label>
                                <li class="text-center">

                                    <select class="form-control">

                                        <option>Select project</option>
                                        <option>Afya Kwanza</option>
                                        <option>D4H</option>
                                        <option>Afya Jumuishi</option>
                                    </select>
                                </li>
                                <br>
                                <label>Activity</label>
                                <li class="text-center">

                                    <select class="form-control">

                                        <option>Select Activity</option>
                                        <option>HTS</option>
                                        <option>Data Collection</option>
                                        <option>Training</option>
                                    </select>
                                </li>
                                <br>
                                <li>
                                    <a href="" class="btn btn-primary text-center btn-block">Get Info</a>
                                </li>
                             <br>
                            </ul>
                        </form>

                    </div>
                </div>
            </div>
{{--            <div class="card panel-theme rounded shadow">--}}
{{--                <div class="card-header">--}}
{{--                    <div class="float-left">--}}
{{--                        <h3 class="card-title">Contact</h3>--}}
{{--                    </div>--}}

{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--               --}}
{{--            </div>--}}
        </div>
        <div class="col-xl-9 col-lg-7 col-md-8">

            <div class="card">
                <div class="col-xs-12 col-sm-6 col-lg-12">
                    <div class="offer offer-success">
                        <div class="shape">
                            <div class="shape-text">

                            </div>
                        </div>
                        <div class="offer-content">
                            <h3 class="lead">
                                Afya Kwanza
                            </h3>
                            <p class="mb-0">
                                2.3.5 To facilitate SI and TA in Data  all other activities must be set here so as user can understand the feeling.

                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <div class="card-body">
                            <div class="list-group">
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Workflow</h5>
                                    </div>
                                    <p class="mb-1">Direct Workflow</p>
                                </div>


                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Sub Program Area</h5>
                                    </div>
                                    <p class="mb-1">HTS</p>
                                </div>
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Numeric Output</h5>
                                    </div>
                                    <p class="mb-1">30</p>
                                </div>
                                <div class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Output unit</h5>
                                    </div>
                                    <p class="mb-1">Viral loads</p>
                                </div>


                            </div>
                    </div>
                    </div>
                    <div class="col-6">
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item justify-content-between"><b>Budget </b><span class="badgetext badge badge-primary badge-pill" style="font-size: larger">$14,000,000</span></li>
                                <li class="list-group-item justify-content-between" ><b>Actual </b><span class="badgetext badge badge-default badge-pill" style="font-size: larger">$0</span></li>
                                <li class="list-group-item justify-content-between"><b>Commitment </b><span class="badgetext badge badge-default badge-pill" style="font-size: larger">$0</span></li>
                                <li class="list-group-item justify-content-between"><b>Reprogrammed </b><span class="badgetext badge badge-default badge-pill" style="font-size: larger">$0</span></li>
                                <li class="list-group-item justify-content-between"><b>Pipeline </b><span class="badgetext badge badge-default badge-pill" style="font-size: larger">$0</span></li>
                                <li class="list-group-item justify-content-between"><b>Available Budget </b><span class="badgetext badge badge-success badge-pill" style="font-size: larger">$14,000</span></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">

            </div>
        </div>
    </div>

    </div>
    </div><!-- end app-content-->

@endsection
