@extends('layouts.app')

@section('content')




    <div class="col-lg-12 col-md-12">
        {!! Form::open(['route' => 'person.health', 'method' => 'post',]) !!}

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Health Details and ID's</span>
                </div>

                <div class="card-options ">
                    <a href="{{route('person.health.create')}}"> <i class="fa fa-plus mr-2"></i>Add Health Details and ID's</a>
                </div>

            </div>

        @csrf
        <div class="card-body">
            <div class="row">

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Blood Group</label>
                        <input type="text" class="form-control" name="blood_group"  required>
                        @error('blood_group')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Weight</label>
                        <input type="text" class="form-control" name="weight"  required>
                        @error('weight')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Height</label>
                        <input type="text" class="form-control" name="height"  required>
                        @error('height')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">National ID</label>
                        <input type="text" class="form-control" name="national_id"  required>
                        @error('national_id')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Drivers Licence</label>
                        <input type="text" class="form-control" name="drivers_licence"  required>
                        @error('drivers_licence')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">Passport Number</label>
                        <input type="text" class="form-control" name="passport_no"  required>
                        @error('passport_no')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label class="form-label">NSSF REG NUMBER</label>
                        <input type="text" class="form-control" name="nssf_reg_no"  required>
                        @error('nssf_reg_no')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>
            </div>
            &nbsp

            <div class="row">

                <div class="col-12">
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-azure"> Register Details </button>
                    </div>
                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
    </div>
@endsection

