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
                            <div class="col-md-4">


                                @if($user->getMedia('profile_pic')->first() != null)
                                    <img src="{{$user->getMedia('profile_pic')->first()->getUrl()}}" style="width: 520px; height: 600px">
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
                                    <dl class="small m-b-none">
                                        <dt>Biography</dt>
                                        @if($bio != null)
                                        <dd> {{$bio->bio}}</dd>
                                            @else
                                            <dd> **This user has not insert user BIO**</dd>
                                            @endif
                                    </dl>

                                    <h6 class="mt-6 font-weight-semibold">Employee Details</h6>
                                    <table class="table table-striped table-bordered m-top20">
                                        <tbody>
                                        <tr>
                                            <th scope="row">Phone Number:</th>
                                            <td><a href="tel:{{$user->phone}}">{{$user->phone}}</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email:</th>
                                            <td><a href="mailto:{{$user->email}}" target="_blank">{{$user->email}}</a></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Working Station:</th>
                                            <td>Dar es Salaam</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Designation:</th>
                                            <td>{{$user->designation->unit->name.' '. $user->designation->name}} </td>
                                        </tr>
                                        </tbody>
                                    </table>

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
