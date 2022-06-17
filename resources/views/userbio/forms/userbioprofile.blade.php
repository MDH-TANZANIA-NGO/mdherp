@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-md-12 wrapper wrapper-content animated fadeInRight">
            <div class="ibox card">
                <div class="card-header">
                    <h3 class="card-title">Know your co-worker</h3>
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-5">


                                @if($user->getMedia('profile_pic')->first() != null)
                                    <img src="{{$user->getMedia('profile_pic')->first()->getUrl()}}" style="width: 500px; height: 620px">
                                @else
                                    <dd> ** Sorry! This user has not uploaded Profile Image**</dd>
                                @endif
                            </div>
                            <div class="col-md-6 ">
                                <div class="card-body p-5">
                                    <h3>
                                        <a href="#" class="text-navy">
                                            {{$user->full_name_formatted}}
                                        </a>
                                    </h3>
                                    <span class="text-gray text-small " >{{$user->designation->unit->name.' '. $user->designation->name}}</span>
                                    <br>
                                    <br>
                                    <dl class="small m-b-none">
                                        <dt>Biography</dt>
                                        @if($bio != null)
                                            <dd> <p style="text-align: justify">{{$bio->bio}}</p> </dd>
                                        @else
                                            <dd> **This user has not insert user BIO**</dd>
                                        @endif
                                    </dl>

                                    {{--                                    <h6 class="mt-6 font-weight-semibold">Employee Details</h6>--}}
                                    {{--                                    <table class="table table-striped table-bordered m-top20">--}}
                                    {{--                                        <tbody>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th scope="row">Phone Number:</th>--}}
                                    {{--                                            <td>{{$user->phone}}</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th scope="row">Email:</th>--}}
                                    {{--                                            <td>{{$user->email}}</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th scope="row">Working Station:</th>--}}
                                    {{--                                            <td>Dar es Salaam</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th scope="row">Designation:</th>--}}
                                    {{--                                            <td>{{$user->designation->unit->name.' '. $user->designation->name}} </td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        </tbody>--}}
                                    {{--                                    </table>--}}
                                    <div class="card panel-theme rounded shadow">
                                        <div class="card-header">
                                            <div class="float-left">
                                                <h3 class="card-title">Contact</h3>
                                            </div>
                                            <div class="card-options text-right">
                                                <a href="#" class="btn btn-sm btn-primary mr-2"><i class="fa fa-facebook"></i></a>
                                                <a href="#" class="btn btn-sm btn-primary mr-2"><i class="fa fa-twitter"></i></a>
                                                <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-linkedin"></i></a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="card-body no-padding rounded">
                                            <ul class="list-group no-margin">
                                                <li class="list-group-item"><i class="fa fa-envelope mr-4"></i> <a href="mailto:{{$user->email}}" target="_blank">{{$user->email}}</a> </li>
                                                <li class="list-group-item"><i class="fa fa-location-arrow mr-4"></i>
                                                    {{$user->region->name}}</li>
                                                <li class="list-group-item"><i class="fa fa-phone mr-4"></i> {{$user->phone}} </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                {{--                                    <a href="" class="mt-2 btn btn-sm btn-pill btn-primary">Buy Now</a>--}}
                                {{--<a href="" class="mt-2 btn btn-sm btn-pill btn-outline-secondary">Add to cart</a>--}}
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            {{--<div class="ibox-content card-footer text-right">
                <a href="" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                <a href="" class="btn btn-primary"><i class="fa fa fa-shopping-cart"></i> Add to Cart</a>
            </div>--}}
        </div>
    </div>
    </div>

@endsection
