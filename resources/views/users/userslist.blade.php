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
                                <li>
                                    <a href="" class="btn btn-primary text-center btn-block">Get Info</a>
                                </li>
                             <br>
                            </ul>
                        </form>

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

            <div class="card">
                <div class="row">
                    <div class="col-6">
                    mamam
                    </div>
                    <div class="col-6">
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <p class=" mb-1 ">Income Budget</p>
                                <h2 class="mb-1">4500,00<span class="fs-12 text-muted ml-1">this month</span></h2>
                                <span class="mb-1 text-muted"><span class="text-danger"><i class="fa fa-caret-down  mr-1"></i> 43.2</span> vs $56,699 than last month</span>
                                <div class="progress progress-xs mt-3">
                                    <div class="progress-bar bg-primary" style="width: 78%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header pt-5 pb-5">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Message">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group card-list-group">
                            <li class="list-group-item py-5">
                                <div class="media m-0">
                                    <div class="media-object avatar brround avatar-md mr-4" style="background-image: url(../../assets/images/users/9.jpg)"></div>
                                    <div class="media-body d-block">
                                        <div class="media-heading">
                                            <small class="float-right text-muted">4 min</small>
                                            <h5>George Mestayer</h5>
                                        </div>
                                        <div>
                                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet
                                        </div>
                                        <ul class="media-list">
                                            <li class="media mt-4">
                                                <div class="media-object brround avatar mr-4" style="background-image: url(../../assets/images/users/7.jpg)"></div>
                                                <div class="media-body">
                                                    Holley Corby:
                                                    I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item py-5">
                                <div class="media m-0">
                                    <div class="media-object avatar brround avatar-md mr-4" style="background-image: url(../../assets/images/users/10.jpg)"></div>
                                    <div class="media-body">
                                        <div class="media-heading">
                                            <small class="float-right text-muted">34 min</small>
                                            <h5>George Mestayer</h5>
                                        </div>
                                        <div>
                                            Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus</div>
                                        <ul class="media-list">
                                            <li class="media mt-4">
                                                <div class="media-object brround avatar mr-4" style="background-image: url(../../assets/images/users/2.jpg)"></div>
                                                <div class="media-body">
                                                    Art Langner:
                                                    master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class=" " id="profile-log-switch">
                                <div class="fade show active " >
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
                                            <div class="media-heading">
                                                <h5><strong>Biography</strong></h5>
                                            </div>
                                            <p>
                                                Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus</p>
                                            <p >because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>
                                        </div>
                                        <img class="img-fluid rounded w-25 h-25 m-2" src="../../assets/images/photos/8.jpg " alt="banner image">
                                        <img class="img-fluid rounded w-25 h-25 m-2" src="../../assets/images/photos/10.jpg" alt="banner image ">
                                        <img class="img-fluid rounded w-25 h-25 m-2" src="../../assets/images/photos/11.jpg" alt="banner image ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Projects</h3>
                            <div class="card-options ">
                                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter border text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td><a href="store.html" class="text-inherit">Untrammelled prevents </a></td>
                                        <td>28 May 2018</td>
                                        <td><span class="status-icon bg-success"></span> Completed</td>
                                        <td>$56,908</td>
                                    </tr>
                                    <tr>
                                        <td><a href="store.html" class="text-inherit">Untrammelled prevents</a></td>
                                        <td>12 June 2018</td>
                                        <td><span class="status-icon bg-danger"></span> On going</td>
                                        <td>$45,087</td>
                                    </tr>
                                    <tr>
                                        <td><a href="store.html" class="text-inherit">Untrammelled prevents</a></td>
                                        <td>12 July 2018</td>
                                        <td><span class="status-icon bg-warning"></span> Pending</td>
                                        <td>$60,123</td>
                                    </tr>
                                    <tr>
                                        <td><a href="store.html" class="text-inherit">Untrammelled prevents</a></td>
                                        <td>14 June 2018</td>
                                        <td><span class="status-icon bg-warning"></span> Pending</td>
                                        <td>$70,435</td>
                                    </tr>
                                    <tr>
                                        <td><a href="store.html" class="text-inherit">Untrammelled prevents</a></td>
                                        <td>25 June 2018</td>
                                        <td><span class="status-icon bg-success"></span> Completed</td>
                                        <td>$15,987</td>
                                    </tr>
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
    </div><!-- end app-content-->

@endsection
