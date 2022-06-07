@extends('layouts.app')

@section('content')

<form action="{{ route('meeting.store') }}" method="post">

    @csrf

    <div class="col-lg-12 col-md-12">

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">User Registration</span>
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
                                    <label class="form-label">Full name</label>
                                    <input type="text" class="form-control" placeholder="Full Name" name="name">
                                    <div class="alert-danger">{{$errors->first('name')}} </div>

                                </div>
                            </div>
                           
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">User</label>
                                    <select class="form-control select2 custom-select" id="active" data-placeholder="Choose one" name="user" required>
                                        <option label="Choose Status"></option>
                                        <option value="Internal">Internal</option>
                                        <option value="External">External </option>

                                    </select>


                                    <div class="alert-danger">{{$errors->first('user')}} </div>
                                </div>
                            </div>




                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="number" class="form-control" placeholder="Phone number" name="mobile_number">
                                    <div class="alert-danger">{{$errors->first('mobile_number')}} </div>
                                </div>
                            </div>


                            <div class="col-sm-6 col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Reg Name</label>
                                    <input type="text" class="form-control" placeholder="Reg Name" name="registration_name">
                                    <div class="alert-danger">{{$errors->first('registration_name')}} </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Work Place </label>
                                    <input type="text" class="form-control" placeholder="Work Place" name="work_place">
                                    <div class="alert-danger">{{$errors->first('work_place')}} </div>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" placeholder="Title" name="title">
                                    <div class="alert-danger">{{$errors->first('title')}} </div>

                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">District</label>
                                    <select class="form-control custom-select select2" name="district_name">
                                        <option value="Select">--Select--</option>
                                        <option value="Kidondoni">Kidondoni</option>
                                        <option value="Ilala">Ilala</option>
                                        <option value="Mbagala">Mbagala</option>
                                        <option value="Temeke">Temeke</option>
                                    </select>
                                    <div class="alert-danger">{{$errors->first('district_name')}} </div>
                                </div>
                            </div>



                           

                            {{-- Status --}}
                            <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                                <span style="color:red;">*</span>Status</label>
                                <select class="form-control form-control-user @error('status') is-invalid @enderror" name="status">
                                    <option selected disabled>Select Status</option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>




                        </div>
                    </div>

                    <button type="submit" onclick="sweetalertclick()" class="btn btn-outline-info" style="margin-left:40%;">Create User</button>

                </div>
            </div>

</form>
<script>
    function sweetalertclick() {
        swal("Stuff Successfully Created", "", "success");
    }
</script>


@endsection