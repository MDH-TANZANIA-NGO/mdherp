@extends('layouts.app')

@section('content')


<div class="card-body">
    <div class="panel panel-primary">


        <div class=" tab-menu-heading card-header" style="background-color: rgb(238, 241, 248)">
            <div class="tabs-menu1 ">
                <!-- Tabs -->
                <ul class="nav panel-tabs">
                    <li class=""><a href="#tab5" class="active" data-toggle="tab">Internal Users <span class="badge badge-success">{{$internal->count()}}</span></a></li>
                    <li class=""><a href="#tab6" data-toggle="tab">External Users <span class="badge badge-danger">{{$external->count()}}</span></a></li>

                </ul>
            </div>

            <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="meeting.create"> <i class="fa fa-plus mr-2"></i>Register User</a>
                </div>
            </div>

        </div>




    </div>


    <div class="panel-body tabs-menu-body">
        <div class="tab-content">
            <div class="tab-pane active" id="tab5">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="one" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">Full name</th>
                                   
                                    <th class="wd-15p">Phone number</th>
                                    <th class="wd-10p">Reg name</th>
                                    <th class="wd-25p">Work place</th>
                                    <th class="wd-25p">Title</th>
                                    <th class="wd-25p">District</th>
                                    
                                    <th class="wd-25p">Status</th>
                                    <th class="wd-25p">Status Update</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($internal as $data)
                                <tr>

                                    <td>{{$data->id}}</td>
                                    <td>{{$data->name}}</td>
                                   
                                    <td> {{$data->mobile_number}}</td>
                                    <td>{{$data->registration_name}}</td>
                                    <td>{{$data->work_place}}</td>
                                    <td>{{$data->title}}</td>
                                    <td>{{$data->district_name}}</td>
                               
                                    <td>
                                        @if ($data->status == 0)
                                        <span class="badge badge-danger">Inactive</span>
                                        @elseif ($data->status == 1)
                                        <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td style="display: flex">
                                        @if ($data->status == 0)
                                        <a href="{{ route('meeting.status', ['user_id' => $data->id, 'status' => 1]) }}" class="btn btn-success m-2">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        @elseif ($data->status == 1)
                                        <a href="{{ route('meeting.status', ['user_id' => $data->id, 'status' => 0]) }}" class="btn btn-danger m-2">
                                            <i class="fa fa-ban"></i>
                                        </a>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('meeting.edit',$data->id) }}"><i class="fa fa-pencil"></i></a>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;

                                        <a onclick="return myFunction();" href="{{ route('meeting.delete',$data->id) }}"><i class="fa fa-trash"></i></a>
                                        <!-- <a href="{{ route('meeting.delete',$data->id) }}" onclick=" sweetalertclick()"><i class="fa fa-trash"></i></a> -->
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
            <div class="tab-pane" id="tab6">

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="two" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="wd-15p">#</th>
                                    <th class="wd-15p">Full name</th>
                                   
                                    <th class="wd-15p">Phone number</th>
                                    <th class="wd-10p">Reg name</th>
                                    <th class="wd-25p">Work place</th>
                                    <th class="wd-25p">Title</th>
                                    <th class="wd-25p">District</th>
                                   
                                    <th class="wd-25p">Status</th>
                                    <th class="wd-25p">Status Update</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($external as $data)
                                <tr>

                                    <td>{{$data->id}}</td>
                                    <td>{{$data->name}}</td>
                                   
                                    <td> {{$data->mobile_number}}</td>
                                    <td>{{$data->registration_name}}</td>
                                    <td>{{$data->work_place}}</td>
                                    <td>{{$data->title}}</td>
                                    <td>{{$data->district_name}}</td>

                                   
                                    <td>
                                        @if ($data->status == 0)
                                        <span class="badge badge-danger">Inactive</span>
                                        @elseif ($data->status == 1)
                                        <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td style="display: flex">
                                        @if ($data->status == 0)
                                        <a href="{{ route('meeting.status', ['user_id' => $data->id, 'status' => 1]) }}" class="btn btn-success m-2">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        @elseif ($data->status == 1)
                                        <a href="{{ route('meeting.status', ['user_id' => $data->id, 'status' => 0]) }}" class="btn btn-danger m-2">
                                            <i class="fa fa-ban"></i>
                                        </a>
                                        @endif

                                    </td>

                                    <td>
                                        <a href="{{ route('meeting.edit',$data->id) }}"><i class="fa fa-pencil"></i></a>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;

                                        <a onclick="return myFunction();" href="{{ route('meeting.delete',$data->id) }}"><i class="fa fa-trash"></i></a>
                                        <!-- <a href="{{ route('meeting.delete',$data->id) }}" onclick=" sweetalertclick()"><i class="fa fa-trash"></i></a> -->
                                    </td>



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
</div>
</div>

</div>




@endsection