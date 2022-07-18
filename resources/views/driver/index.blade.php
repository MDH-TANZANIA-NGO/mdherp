@extends('layouts.app')

@section('content')



<div class="card-body p-6">
    <div class="panel panel-primary">



        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->

            </div>


            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="/driver/create"> <i class="fa fa-plus mr-2"></i>Assign Driver</a>
                </div>
            </div>


        </div>

        <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
            <div class="tab-content">
                <div class="tab-pane active" id="all">

                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="123" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="wd-15p">#</th>
                                        <th class="wd-15p">License Number</th>
                                        <th class="wd-15p">Class type of license</th>
                                        <th class="wd-10p">Driver</th>
                                        <th class="wd-25p">License expiry date</th>
                                        <th class="wd-25p">Vehicle</th>
                                        <th class="wd-25p">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($driver as $data)
                                    <tr>

                                        <td>{{$data->id}}</td>
                                        <td>{{$data->license_no}}</td>
                                        <td> {{$data->class_type_of_license}}</td>
                                        <td>{{$data->user->full_name}}</td>
                                        <td>{{$data->license_expiry_date}}</td>
                                        <td> {{$data->fleet->maker}}-{{$data->fleet->model}}({{$data->fleet->vehicle_reg_no}}) </td>



                                        <td>
                                            <a href="{{route('driver-edit',$data->id)}}"><i class="fa fa-pencil"></i></a>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;

                                            <a onclick="return myFunction();" href="{{ route('driver-delete',$data->id) }}"><i class="fa fa-trash"></i></a>

                                        </td>

                                    </tr>
                                    @endforeach
                                    <script>
                                        function myFunction() {
                                            if (!confirm("Are You Sure to delete this"))
                                                event.preventDefault();
                                        }
                                    </script>

                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>




            </div>
        </div>


        @endsection