@extends('layouts.app')
@section('content')

    <div class="row mt-5">
        <div class="col-xl-12 col-lg-12 col-md-12"></div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
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
{{--                                <select class="form-control select2 custom-select" data-placeholder="Choose one">--}}
{{--                                    <option label="Choose one">--}}
{{--                                    </option>--}}
{{--                                    <option value="1">Female</option>--}}
{{--                                    <option value="2">Male</option>--}}
{{--                                </select>--}}

                                {!! Form::select('region', $gender, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Marital Status</label>
                                {!! Form::select('region', $marital, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Designation</label>
                                {!! Form::select('region', $designations, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label class="form-label">Region</label>
                                {!! Form::select('region', $regions, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            </div>
                        </div>
                        <div class=" col-md-4">

                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-left:40%;">Register</button>

                    </div>
                </div>

            </form>
        </div>
    </div>

@endsection
