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
                            <div class="col-md-12 col-lg-5">
                                <div class="cart-product-imitation bg-gray">
                                    <img src="../../assets/images/products/8.png" alt="">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-7">
                                <div class="card-body p-5">
                                    <h3>
                                        <a href="#" class="text-navy">
                                           Full Name
                                        </a>
                                    </h3>
                                    <p class="small">
                                      Accademic details
                                    </p>
                                    <dl class="small m-b-none">
                                        <dt>Biography</dt>
                                        <dd> Bio goes here</dd>
                                    </dl>

{{--                                    <a href="" class="mt-2 btn btn-sm btn-pill btn-primary">Buy Now</a>--}}
                                    {{--<a href="" class="mt-2 btn btn-sm btn-pill btn-outline-secondary">Add to cart</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-6 font-weight-semibold">Employee Details</h6>
                    <table class="table table-striped table-bordered m-top20">
                        <tbody>
                        <tr>
                            <th scope="row">Phone Number:</th>
                            <td>07xxxxxxxx</td>
                        </tr>
                        <tr>
                            <th scope="row">Email:</th>
                            <td>example@mdh.or.tz</td>
                        </tr>
                        <tr>
                            <th scope="row">Working Station:</th>
                            <td>Dar es Salaam</td>
                        </tr>
                        <tr>
                            <th scope="row">Designation:</th>
                            <td>Senior M&E Manager </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                {{--<div class="ibox-content card-footer text-right">
                    <a href="" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                    <a href="" class="btn btn-primary"><i class="fa fa fa-shopping-cart"></i> Add to Cart</a>
                </div>--}}
            </div>
        </div>
    </div>

@endsection
