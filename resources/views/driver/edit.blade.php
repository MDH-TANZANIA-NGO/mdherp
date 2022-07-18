@extends('layouts.app')

@section('content')

<form action="{{route('driver-update', $driver->id)}}" method="post">



    @csrf
    <input type="hidden" name="id" value="{{$driver->id}}">
    <div class="col-lg-12 col-md-12">

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Driver Update</span>
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
                                    <input type="text" class="form-control" placeholder="license Number" name="license_no" value="{{$driver->license_no}}">
                                    <div class="alert-danger">{{$errors->first('license_no')}} </div>

                                </div>
                            </div>

                            <div class=" col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Class type of license</label>
                                    <input type="text" class="form-control" placeholder="Class type of license" name="class_type_of_license" value="{{$driver->class_type_of_license}}">
                                    <div class="alert-danger">{{$errors->first('class_type_of_license')}} </div>
                                </div>
                            </div>



                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Driver</label>
                                    <select class="form-control custom-select select2" name="user_id">
                                        <option selected disabled>Select Role</option>
                                        @foreach ($users as $user)
                                        <option value="{{$user->id}}" {{old('user_id') ? ((old('user_id') == $user->id) ? 'selected' : '') : (($driver->user_id == $user->id) ? 'selected' : '')}}>
                                            {{$user->full_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="alert-danger">{{$errors->first('user_id')}} </div>
                                </div>
                            </div>



                            <div class=" col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">License expiry date</label>
                                    <input type="date" class="form-control" placeholder="License expiry date" name="license_expiry_date" value="{{$driver->license_expiry_date}}">
                                    <div class="alert-danger">{{$errors->first('license_expiry_date')}} </div>
                                </div>
                            </div>

                            <div class=" col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Vehicle</label>
                                    <select class="form-control custom-select select2" name="fleet_id">
                                        <option selected disabled>Select Role</option>
                                        @foreach ($fleets as $fleet)
                                        <option value="{{$fleet->id}}" {{old('fleet_id') ? ((old('fleet_id') == $fleet->id) ? 'selected' : '') : (($driver->fleet_id == $fleet->id) ? 'selected' : '')}}>
                                            {{$fleet->maker}} - {{$fleet->model}}( {{$fleet->vehicle_reg_no}})
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="alert-danger">{{$errors->first('fleet_id')}} </div>

                                </div>
                            </div>



                        </div>
                    </div>

                    <button type=" submit" onclick="sweetalertclick()" class="btn btn-outline-info" style="margin-left:40%;">Update</button>

                </div>
            </div>

</form>
<script>
    function sweetalertclick() {
        swal("Driver Successfully Updated", "", "success");
    }
</script>





@endsection