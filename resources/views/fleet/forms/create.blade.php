@extends('layouts.app')

@section('content')

    {!! Form::open(['route' => 'fleet.store', 'method' => 'post',]) !!}

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

                        <div class="col-4" >
                            <label class="form-label">Vehicle Type</label>
                            <input type="text" class="form-control" name="vehicle_type" placeholder="" required>
                            @error('code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label">Vehicle Maker</label>
                            <input type="text" class="form-control" name="maker" placeholder="ie. Toyota" required>
                            @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label">Vehicle Model</label>
                            <input type="text" class="form-control" name="model" placeholder="ie. Land Cruiser" required>
                            {{--                            {!! Form::select('type', $types, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}--}}
                            @error('type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                    </div>

                    &nbsp;

                    <div class="row">

                        <div class="col-4" >
                            <label class="form-label">Body Type</label>
                            <input type="text" class="form-control" name="body_type" placeholder="ie. SUV" required>
                            @error('code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label">Year</label>
                            <input type="text" class="form-control" name="year" placeholder="ie. 1999" required>
                            @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label">Color</label>
                            <input type="text" class="form-control" name="color" placeholder="ie. Black" required>
                            {{--                            {!! Form::select('type', $types, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}--}}
                            @error('type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                    </div>

                    &nbsp;

                    <div class="row">

                        <div class="col-4" >
                            <label class="form-label">Country of origin</label>
                            <input type="text" class="form-control" name="origin_country" placeholder="Japan" required>
                            @error('code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label">Fuel Type</label>
                            <input type="text" class="form-control" name="fuel_type" placeholder="" required>
                            @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label">Engine size</label>
                            <input type="text" class="form-control" name="engine_size" placeholder="cc" required>
                            {{--                            {!! Form::select('type', $types, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}--}}
                            @error('type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                    </div>

                    &nbsp;

                    <div class="row">

                        <div class="col-4" >
                            <label class="form-label">Chasis number</label>
                            <input type="text" class="form-control" name="chasis_no" placeholder="" required>
                            @error('code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label">Registration Number</label>
                            <input type="text" class="form-control" name="vehicle_reg_no" placeholder="T116DQB" required>
                            @error('title')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label class="form-label">Assign Driver</label>
                            <input type="text" class="form-control" name="driver" placeholder="" required>
                            {{--                            {!! Form::select('type', $types, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}--}}
                            @error('type')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                    </div>

                    &nbsp;

                    &nbsp;<div class="row">

                        <div class="col-4" >
                            <label class="form-label">Vehicle Status</label>
                            <input type="text" class="form-control" name="isactive" placeholder="" required>
                            @error('code')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>


                    </div>
                    &nbsp;

                    &nbsp;

                    <div class="row">

                        <div class="col-12">
                            <div style="text-align: center;">

                                <button type="submit" class="btn btn-azure"  >Register Vehicle </button>

                            </div>
                        </div>

                    </div>

{{--                    @if($message = session::get('success'))--}}

{{--                    <div class="row">--}}

{{--                        <div class="col-12">--}}
{{--                            <div class="alert alert-success" style="text-align: center;">--}}

{{--                        {{$message}}--}}

{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                    @endif--}}

                </div>


        </div>
    </div>

    {!! Form::close() !!}

@endsection
