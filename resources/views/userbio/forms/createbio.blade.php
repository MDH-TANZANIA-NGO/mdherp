@extends('layouts.app')

@section('content')


    <div class="row">
        <div class="col-xl-3 col-lg-5 col-md-12">
            <div class="card ">
                <div class="card-body">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-center border-bottom-0">
                                <img data-no-retina="" class="img-circle img-responsive img-bordered-primary" src="../../assets/images/users/16.jpg" alt="John Doe">
                            </li>
                            <li class="text-center">
                                <h4 class="text-capitalize mt-3 mb-0">John Thomson</h4>
                                <p class="text-muted text-capitalize">App Developer</p>
                            </li>

                            <li><br></li>
                            <li>
                                <div class="btn-group-vertical btn-block border-top-0">
                                    <a href="" class="btn btn-outline-primary"><i class="fe fe-upload mr-2"></i>Upload</a>
                                    <a href="" class="btn btn-primary"><i class="fe fe-settings mr-2"></i>Edit Account</a>
                                    <a href="" class="btn btn-outline-primary"><i class="fe fe-alert-circle mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card panel-theme rounded shadow">
                <div class="card-header">
                    <div class="float-left">
                        <h3 class="card-title">Contact</h3>
                    </div>
                    <div class="card-options text-right">
                        <a href="#" class="btn btn-sm btn-primary mr-2"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="btn btn-sm btn-primary mr-2"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="btn btn-sm btn-primary"><i class="fa fa-google-plus"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body no-padding rounded">
                    <ul class="list-group no-margin">
                        <li class="list-group-item"><i class="fa fa-envelope mr-4"></i> support@demo.com</li>
                        <li class="list-group-item"><i class="fa fa-globe mr-4"></i> www.support.com</li>
                        <li class="list-group-item"><i class="fa fa-phone mr-4"></i> +125 5826 3658 </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-7 col-md-12">


            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <div class=" " id="profile-log-switch">
                                <div class="fade show active ">
                                    <div class="table-responsive border ">
                                        <table class="table row table-borderless w-100 m-0 ">
                                            <tbody class="col-lg-6 p-0">
                                            <tr>
                                                <td><strong>Full Name :</strong> John Thomson </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Location :</strong> USA</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Languages :</strong> English, German, Spanish.</td>
                                            </tr>
                                            </tbody>
                                            <tbody class="col-lg-6 p-0">
                                            <tr>
                                                <td><strong>Website :</strong> Clont.com</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email :</strong> georgemestayer@Clont.com</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Phone :</strong> +125 254 3562 </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mt-5 profie-img">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Background Information: <span class="form-label-small">56/100</span></label>
                                                <textarea class="form-control" name="activity_report" rows="2" placeholder="Write activity report.." required></textarea>
                                            </div>
                                        </div>
<div class="col-md-6 align-content-center content-center">
    <a href="" class="btn btn-primary text-center btn-block">Update Bio</a>
</div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
