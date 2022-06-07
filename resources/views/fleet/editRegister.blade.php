@extends('layouts.app')

@section('content')
<form action="{{ route('fleet.register.update',$car->id) }}" method="post">

    @csrf

    <div class="col-lg-12 col-md-12">

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Register Fleets</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>

            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-4">
                        <label class="form-label">Vehicle Type</label>
                        <select class="form-control select2-show-search" name=" vehicle_type" required>

                            <option value="Car" {{$car -> vehicle_type =="Car" ? 'selected':''}}> Car</option>
                            <option value="Motor Bike" {{$car -> vehicle_type =="Motor Bike" ? 'selected':''}}>Motor bike</option>
                            <option value="Bajaj" {{$car -> vehicle_type =="Bajaj" ? 'selected':''}}>Bajaj</option>

                        </select>

                    </div>

                    <div class="col-4">

                        <label class="form-label">Vehicle Maker</label>

                        <select class="form-control select2-show-search" name="maker" required>

                            <option value="Toyota" {{$car -> vehicle_type =="Toyota" ? 'selected':''}}>Toyota</option>
                            <option value="Nissan" {{$car -> vehicle_type =="Nissan" ? 'selected':''}}>Nissan</option>
                            <option value="Land Rover" {{$car -> vehicle_type =="Land Rover" ? 'selected':''}}>Land Rover</option>
                            <option value="Volks Wagen" {{$car -> vehicle_type =="Volks Wagen" ? 'selected':''}}>Volks Wagen</option>
                            <option value="Bajaj" {{$car -> vehicle_type =="Bajaj" ? 'selected':''}}>Bajaj</option>
                            <option value="SanLG" {{$car -> vehicle_type =="SanLG" ? 'selected':''}}>SanLG</option>
                            <option value="Toyo" {{$car -> vehicle_type =="Toyo" ? 'selected':''}}>Toyo</option>
                            <option></option>

                        </select>


                    </div>

                    <div class="col-4">
                        <label class="form-label">Vehicle Model</label>
                        <input type="text" class="form-control" value="{{$car->model}}" name="model" placeholder="ie. Land Cruiser" required>

                    </div>

                </div>

                &nbsp;

                <div class="row">

                    <div class="col-4">
                        <label class="form-label">Body Type</label>
                        <input type="text" class="form-control" value="{{$car->body_type}}" name="body_type" placeholder="ie. SUV" required>

                    </div>

                    <div class="col-4">
                        <label class="form-label">Year</label>
                        <input type="text" class="form-control" value="{{$car->year}}" name="year" placeholder="ie. 1999" required>

                    </div>

                    <div class="col-4">
                        <label class="form-label">Color</label>
                        <input type="text" class="form-control" value="{{$car->color}}" name="color" placeholder="ie. Black" required>

                    </div>

                </div>

                &nbsp;

                <div class="row">

                    <div class="col-4">
                        <label class="form-label">Country of origin</label>
                        <input type="text" class="form-control" name="origin_country" value="{{$car->origin_country}}" placeholder="Japan" required>

                    </div>

                    <div class="col-4">
                        <label class="form-label">Fuel Type</label>
                        <input type="text" class="form-control" value="{{$car->fuel_type}}" name="fuel_type" placeholder="" required>

                    </div>

                    <div class="col-4">
                        <label class="form-label">Engine size</label>
                        <input type="text" class="form-control" value="{{$car->engine_size}}" name="engine_size" placeholder="cc" required>

                    </div>

                </div>

                &nbsp;

                <div class="row">

                    <div class="col-4">
                        <label class="form-label">Chasis number</label>
                        <input type="text" class="form-control" value="{{$car->chasis_no}}" name="chasis_no" placeholder="" required>

                    </div>

                    <div class="col-4">
                        <label class="form-label">Registration Number</label>
                        <input type="text" class="form-control" value="{{$car->vehicle_reg_no}}" name="vehicle_reg_no" placeholder="T116DQB" required>

                    </div>

                    <div class="col-4">
                        <label class="form-label">Assign Driver</label>
                        <input type="text" class="form-control" name="driver" value="{{$car->driver}}" placeholder="" required>

                    </div>

                </div>

                &nbsp;

                &nbsp;<div class="row">

                    <div class="col-4">
                        <label class="form-label">Vehicle Status</label>
                        {{-- <input type="text" class="form-control" value="{{$car->isactive}}" name="isactive" placeholder="" required>--}}
                        <select class="form-control select2 custom-select" name="isactive" required>

                            <option value="Active" {{$car -> vehicle_type =="Active" ? 'selected':''}}>Active</option>
                            <option value="InActive" {{$car -> vehicle_type =="InActive" ? 'selected':''}}>InActive</option>

                        </select>

                    </div>


                </div>

                <div class="row">

                    <div class="col-12">
                        <div style="text-align: center;">

                            <button type="submit" class="btn btn-azure">Update Vehicle </button>

                        </div>
                    </div>

                </div>



            </div>


        </div>
    </div>

 



    @endsection