@extends('layouts.app')

@section('content')
<div class="container">
    
                <div class="row flex-lg-nowrap">
                    <div class="col">
                        <div class="row flex-lg-nowrap">
                            <div class="col mb-3">
                                <div class="e-panel card">
                                    <div class="card-header">
                                        <h3 class="card-title">Users List</h3>
                                        <div class="card-options ">
                                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="e-table">
                                            <div class="table-responsive table-lg mt-3">
                                                <table class="table table-bordered border-top">
                                                    <thead>
                                                        <tr>
                                                            <th class="align-top">
                                                            </th>
                                                            {{-- <th>Photo</th> --}}
                                                            <th class="max-width">Full Name</th>
                                                            <th class="sortable">Join Date</th>
                                                            <th> Activate/Deactivate</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="align-middle">
                                                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                                    <input type="checkbox" class="custom-control-input" id="item-1">
                                                                    <label class="custom-control-label" for="item-1"></label>
                                                                </div>
                                                            </td>
                                                            {{-- <td class="align-middle text-center">
                                                                <span class="avatar brround avatar-md d-block" style="background-image: url(../../assets/images/users/2.jpg)"></span>
                                                            </td> --}}
                                                            <td class="text-nowrap align-middle">Frank Omary</td>
                                                            <td class="text-nowrap align-middle"><span>01 OCT 2021</span></td>
                                                            <td class="text-center align-middle">
                                                                <label class="custom-switch">
                                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="btn-group align-top">
                                                                    <button class="btn btn-sm btn-outline-primary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                                    {{-- <button class="btn btn-sm btn-outline-primary badge" type="button"><i class="fa fa-trash"></i></button> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle">
                                                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                                    <input type="checkbox" class="custom-control-input" id="item-2">
                                                                    <label class="custom-control-label" for="item-2"></label>
                                                                </div>
                                                            </td>
                                                            {{-- <td class="align-middle text-center">
                                                                <span class="avatar brround avatar-md d-block" style="background-image: url(../../assets/images/users/13.jpg)"></span>
                                                            </td> --}}
                                                            <td class="text-nowrap align-middle">Moses Kehengu</td>
                                                            <td class="text-nowrap align-middle"><span>01 Oct 2021</span></td>
                                                            <td class="text-center align-middle">
                                                                <label class="custom-switch">
                                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="btn-group align-top">
                                                                    <button class="btn btn-sm btn-outline-primary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                                    {{-- <button class="btn btn-sm btn-outline-primary badge" type="button"><i class="fa fa-trash"></i></button> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle">
                                                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                                    <input type="checkbox" class="custom-control-input" id="item-3">
                                                                    <label class="custom-control-label" for="item-3"></label>
                                                                </div>
                                                            </td>
                                                            {{-- <td class="align-middle text-center">
                                                                <span class="avatar brround avatar-md d-block" style="background-image: url(../../assets/images/users/3.jpg)"></span>
                                                            </td> --}}
                                                            <td class="text-nowrap align-middle">Kelvin Kiritta</td>
                                                            <td class="text-nowrap align-middle"><span>27 Jan 2018</span></td>
                                                            <td class="text-center align-middle">
                                                                <label class="custom-switch">
                                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="btn-group align-top">
                                                                    <button class="btn btn-sm btn-outline-primary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                                    {{-- <button class="btn btn-sm btn-outline-primary badge" type="button"><i class="fa fa-trash"></i></button> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-middle">
                                                                <div class="custom-control custom-control-inline custom-checkbox custom-control-nameless m-0 align-top">
                                                                    <input type="checkbox" class="custom-control-input" id="item-4">
                                                                    <label class="custom-control-label" for="item-4"></label>
                                                                </div>
                                                            </td>
                                                            {{-- <td class="align-middle text-center">
                                                                <span class="avatar brround avatar-md d-block" style="background-image: url(../../assets/images/users/14.jpg)"></span>
                                                            </td> --}}
                                                            <td class="text-nowrap align-middle">Lameck Machumi</td>
                                                            <td class="text-nowrap align-middle"><span>20 Jan 2011</span></td>
                                                            <td class="text-center align-middle">
                                                                <label class="custom-switch">
                                                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
                                                                    <span class="custom-switch-indicator"></span>
                                                                </label>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div class="btn-group align-top">
                                                                    <button class="btn btn-sm btn-outline-primary badge" type="button" data-toggle="modal" data-target="#user-form-modal">Edit</button>
                                                                    {{-- <button class="btn btn-sm btn-outline-primary badge" type="button"><i class="fa fa-trash"></i></button> --}}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <ul class="pagination mt-3 mb-0">
                                                    <li class="disabled page-item"><a href="#" class="page-link">‹</a></li>
                                                    <li class="active page-item"><a href="#" class="page-link">1</a></li>
                                                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                                                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                                                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                                                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                                                    <li class="page-item"><a href="#" class="page-link">›</a></li>
                                                    <li class="page-item"><a href="#" class="page-link">»</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <button class="btn btn-primary btn-block" type="button" data-toggle="modal" data-target="#user-form-modal">New User</button>
                                        </div>
                                        <div class="mt-4">
                                            
                                            <div class="form-group">
                                                <label>Search by Name:</label>
                                                <div><input class="form-control w-100" type="text" placeholder="Name" value=""></div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <label>Status:</label>
                                            <div class="px-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="user-status" id="users-status-disabled">
                                                    <label class="custom-control-label" for="users-status-disabled">Disabled</label>
                                                </div>
                                            </div>
                                            <div class="px-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="user-status" id="users-status-active">
                                                    <label class="custom-control-label" for="users-status-active">Active</label>
                                                </div>
                                            </div>
                                            <div class="px-2">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="user-status" id="users-status-any" checked="">
                                                    <label class="custom-control-label" for="users-status-any">Any</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Form Modal -->
                        <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit User</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="py-1">
                                            <form class="form" novalidate="">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>First Name</label>
                                                                    <input class="form-control" type="text" name="first_ame" placeholder="First Name" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Last Name</label>
                                                                    <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Email</label>
                                                                    <input class="form-control" type="email" placeholder="initials@mdh.or.tz">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <div class="form-group">
                                                                    <label>About</label>
                                                                    <textarea class="form-control" rows="5" placeholder="User's Biography"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="row">
                                                     <div class="col-12 col-sm-6 mb-3">
                                                        <div class="mb-2"><b>Change Password</b></div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Current Password</label>
                                                                    <input class="form-control" type="password" placeholder="••••••">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>New Password</label>
                                                                    <input class="form-control" type="password" placeholder="••••••">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                                                                    <input class="form-control" type="password" placeholder="••••••">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                                                        <div class="mb-2"><b>Keeping in Touch</b></div>
                                                        <div class="row">
                                                            <div class="col">
                                                            <label>Email Notifications</label>
                                                                <div class="custom-controls-stacked px-2">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                                                                        <label class="custom-control-label" for="notifications-blog">Blog posts</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="notifications-news" checked="">
                                                                        <label class="custom-control-label" for="notifications-news">Newsletter</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="notifications-offers" checked="">
                                                                        <label class="custom-control-label" for="notifications-offers">Personal Offers</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="row">
                                                    <div class="col d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                                    </div>
                                                    <div class="col d-flex justify-content">
                                                        <button class="btn btn-info" type="submit">Reset Password</button>
                                                        </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               
    </div>
</div>
@endsection
