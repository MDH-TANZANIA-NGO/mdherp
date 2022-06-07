@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<div class="col-lg-12 col-md-12">

    <div class="card">

        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Fleets</span>
            </div>

            <div class="card-options ">

                <div class="btn-group mb-0">
                    <a href="{{ route('fleet.register.create') }}"> <i class="fa fa-plus mr-2"></i>Register vehicle</a>
                </div>

                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            </div>

        </div>

        <div class="card-body">
            <div class="panel panel-primary">
                <div class=" tab-menu-heading">
                    <div class="tabs-menu1 ">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class=""><a href="#tab5" class="active" data-toggle="tab">Active Vehicles <span class="badge badge-success">{{$active_car->count()}}</span></a></li>
                            <li class=""><a href="#tab6" data-toggle="tab">Inactive Vehicles <span class="badge badge-danger">{{$inactive_car->count()}}</span></a></li>
                        </ul>
                    </div>



                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab5">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="123" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>

                                                <th class="wd-15p">Type</th>
                                                <th class="wd-20p">Body</th>
                                                <th class="wd-20p">Country</th>
                                                <th class="wd-20p">Fuel type</th>
                                                <th class="wd-10p">Chasis number</th>
                                                <th class="wd-10p">Vehicle Registration number</th>
                                                <th class="wd-20p">Driver</th>
                                                <th class="wd-20p">Action</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($active_car as $item)
                                            <tr>

                                                <td>{{$item->vehicle_type}}</td>
                                                <td>{{$item->body_type}}</td>
                                                <td>{{$item->origin_country}}</td>
                                                <td> {{$item->fuel_type}}</td>
                                                <td>{{$item->chasis_no}}</td>
                                                <td>{{$item->vehicle_reg_no}}</td>
                                                <td>{{$item->driver}}</td>
                                                <td>
                                                    <a href="{{ route('fleet.register.view',$item->id) }}"><i class="fa fa-pencil"></i></a>
                                                    &nbsp;
                                                    &nbsp;
                                                    &nbsp;
                                                    <a href="{{ route('fleet.register.destroy',$item->id) }}"><i class="fa fa-trash"></i></a>
                                                </td>


                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab6">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="124" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p">Type</th>
                                                <th class="wd-20p">Body</th>
                                                <th class="wd-20p">Country</th>
                                                <th class="wd-20p">Fuel type</th>
                                                <th class="wd-10p">Chasis number</th>
                                                <th class="wd-10p">Vehicle Registration number</th>
                                                <th class="wd-20p">Driver</th>
                                                <th class="wd-20p">Action</th>
                                        </thead>
                                        <tbody>
                                            @foreach($inactive_car as $item)
                                            <tr>

                                                <td>{{$item->vehicle_type}}</td>
                                                <td>{{$item->body_type}}</td>
                                                <td>{{$item->origin_country}}</td>
                                                <td> {{$item->fuel_type}}</td>
                                                <td>{{$item->chasis_no}}</td>
                                                <td>{{$item->vehicle_reg_no}}</td>
                                                <td>{{$item->driver}}</td>

                                                <td>
                                                    <a href="{{ route('fleet.register.view',$item->id) }}"><i class="fa fa-pencil"></i></a>
                                                    &nbsp;
                                                    &nbsp;
                                                    &nbsp;
                                                    <a href="{{ route('fleet.register.destroy',$item->id) }}"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
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
</div>

<script>
    $(document).ready(function() {
        $('123').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $('124').DataTable();
    });
</script>

@endsection