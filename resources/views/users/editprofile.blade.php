@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Profile</h3>
        <div class="card-options ">
            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body p-6">
        <div class="panel panel-primary">
            <div class="tab-menu-heading">
                <div class="tabs-menu ">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class=""><a href="#tab1" class="active" data-toggle="tab">Details</a></li>
                        <li><a href="#tab2" data-toggle="tab">Edit</a></li>
                        <li><a href="#tab3" data-toggle="tab">Permissions</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body">
                <div class="tab-content">
                    <div class="tab-pane active " id="tab1">
                    	<div class="table-responsive border ">
                            <table class="table row table-borderless w-100 m-0 ">
                                <tbody class="col-lg-6 p-0">
                                    <tr>
                                        <td><strong>Full Name :</strong> John Thomson </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Working Station :</strong> Ilala DC</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Designation</strong> ICT cum software developer</td>
                                    </tr>
                                </tbody>
                           
                                <tbody class="col-lg-6 p-0">
                                    <tr>
                                        <td><strong>Gender :</strong> Female</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date of Birth :</strong>09/09/1965</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Marital Status :</strong> Single</td>
                                    </tr>
                                </tbody>
                                <tbody class="col-lg-6 p-0">
                                    <tr>
                                        <td><strong>Department :</strong> Strategic Information</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email :</strong> georgemestayer@Clont.com</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Phone :</strong> +125 254 3562 </td>
                                    </tr>
                                </tbody>
                                <tbody class="col-lg-6 p-0">
                                    <tr>
                                        <td><strong>Postal Code :</strong> 12098</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Registered Date :</strong> 12/09/2021</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Role :</strong> Admin</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                       
                    </div>
                    <div class="tab-pane  " id="tab2">
                        <form class="card">
                    
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control"  placeholder="First Name" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" placeholder="Middle Name" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Last Name</label>
                                            <input type="email" class="form-control" placeholder="Last Name">
                                        </div>
                                    </div>
                             
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control"  placeholder="Date of Birth" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <input type="number" class="form-control" placeholder="i.e 0689000333">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="form-label">Gender</label>
                                            <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                <option label="Choose one">
                                                </option>
                                                <option value="1">Female</option>
                                                <option value="2">Male</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="form-label">Marital Status</label>
                                            <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                <option label="Choose one">
                                                </option>
                                                <option value="1">Single</option>
                                                <option value="2">Married</option>
                                                <option value="3">Divorced</option>
                                                <option value="4">widowed</option>
                                                <option value="5">Separated</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="form-label">Departments</label>
                                            <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                <option label="Choose one">
                                                </option>
                                                <option value="2">Finance</option>
                                                <option value="1">Strategic Information</option>
                                                <option value="2">Finance</option>
                                                <option value="3">Human Resource</option>
                                                <option value="4">Administration</option>
                                                <option value="5">Grants</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="form-label">Designation</label>
                                            <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                <option label="Choose one">
                                                </option>
                                                <option value="1">Chuck Testa</option>
                                                <option value="2">Sage Cattabriga-Alosa</option>
                                                <option value="3">Nikola Tesla</option>
                                                <option value="4">Cattabriga-Alosa</option>
                                                <option value="5">Nikola Alosa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label class="form-label">Working Station</label>
                                            <select class="form-control select2 custom-select" data-placeholder="Choose one">
                                                <option label="Choose one">
                                                </option>
                                                <option value="1">Chuck Testa</option>
                                                <option value="2">Sage Cattabriga-Alosa</option>
                                                <option value="3">Nikola Tesla</option>
                                                <option value="4">Cattabriga-Alosa</option>
                                                <option value="5">Nikola Alosa</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class=" col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Postal Code</label>
                                            <input type="number" class="form-control" placeholder="ZIP Code">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" style="margin-left:40%;">Update Profile</button>
                          
                                </div>
                            </div>
                            
                        </form>
                        
                    </div>
                    <div class="tab-pane " id="tab3">
                  
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection