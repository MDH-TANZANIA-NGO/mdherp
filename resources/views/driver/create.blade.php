@extends('layouts.app')

@section('content')

<form action="{{route('driver-store')}}" method="post">

    @csrf

    <div class="col-lg-12 col-md-12">

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Assign Driver</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>

            </div>

            <div class="card-body">
                <div class="row">


                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">License Number</label>
                                    <input type="text" class="form-control" placeholder="license Number" name="license_no">
                                    <div class="alert-danger">{{$errors->first('license_no')}} </div>

                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Class type of license</label>
                                    <input type="text" class="form-control" placeholder="Class type of license" name="class_type_of_license">
                                    <div class="alert-danger">{{$errors->first('class_type_of_license')}} </div>
                                </div>
                            </div>





                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Driver</label>
                                    <select class="form-control custom-select select2" name="user_id">
                                        <option selected disabled>Select Driver</option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->full_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="alert-danger">{{$errors->first('user_id')}} </div>

                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">License expiry date</label>
                                    <input type="date" class="form-control" placeholder="License expiry date" name="license_expiry_date">
                                    <div class="alert-danger">{{$errors->first('license_expiry_date')}} </div>
                                </div>
                            </div>



                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">vehicle</label>
                                    <select class="form-control custom-select select2" name="fleet_id">
                                        <option selected disabled>Select Driver</option>
                                        @foreach ($fleets as $fleet)
                                        <option value="{{$fleet->id}}"> {{$fleet->maker}} - {{$fleet->model}}( {{$fleet->vehicle_reg_no}})</option>
                                        @endforeach
                                    </select>
                                    <div class="alert-danger">{{$errors->first('fleet_id')}} </div>

                                </div>
                            </div>


                        </div>
                    </div>

                    <button type="submit" onclick="sweetalertclick()" class="btn btn-outline-info" style="margin-left:40%;">Assign Driver</button>

                </div>
            </div>

</form>
<script>
    function sweetalertclick() {
        swal("Driver Assigned Successfully ", "", "success");
    }
</script>


@endsection