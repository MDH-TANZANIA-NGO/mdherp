@extends('layouts.app')

@section('content')



    <div class="col-lg-12 col-md-12">
        {!! Form::open(['route' => ['user.update', $user], 'method' => 'put']) !!}

        @csrf
        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Personal Information</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>

            </div>

            <div class="card-body">
                <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('identity_number', "Staff Identity Number",['class'=>'form-label','required_asterik']) !!}
                                {!! Form::text('identity_number',$user->identity_number,['class' => 'form-control', 'placeholder' => '','disabled']) !!}
                                {!! Form::text('identity_number',$user->identity_number,['class' => 'form-control', 'placeholder' => '','hidden']) !!}
                                {!! $errors->first('identity_number', '<span class="badge badge-danger">:message</span>') !!}
                            </div>
                        </div>
                </div>
                    <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('first_name',$user->first_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('middle_name', __("label.name.middle"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('middle_name',$user->middle_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('name', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('last_name', __("label.name.last"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('last_name',$user->last_name,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('last_name', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('dob', __("label.dob"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::date('dob',$user->dob,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('dob', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('email', __("label.email"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::email('email',$user->email,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('email', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('phone',$user->phone,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('gender', __("label.gender"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('gender', $gender, $user->gender_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('gender', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('marital', __("label.marital"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('marital', $marital, $user->marital_status_cv_id, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('marital', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('designation', __("label.designation"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('designation', $designations, $user->designation_id, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('designation', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('region', __("label.region"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('region', $regions, $user->region_id, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                            {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('employed_date', "First Appointment",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::date('employed_date',$user->employed_date,['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('employed_date', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-12">
                        <div style="text-align: center;">

                            <button type="submit" class="btn btn-azure"  >Update Personal Information </button>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>

    &nbsp;
    &nbsp;
    <div class="col-lg-12 col-md-12">
        {!! Form::open(['route' => ['person.health.update', $employee?? ''], 'method' => 'put',]) !!}

        @csrf
        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Health Details and ID's</span>
                </div>

                <div class="card-options ">
                    <a href="{{route('person.health.create')}}"> <i class="fa fa-plus mr-2"></i>Add Health Details and ID's</a>
                </div>

            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('blood_group', "Blood Group",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('blood_group',$employee->blood_group ?? '',['class' => 'form-control', 'placeholder' => '','disabled']) !!}
                            {!! $errors->first('blood_group', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('weight', "Weight",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('weight',$employee->weight ?? '',['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('weight', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('height', "Height",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('height',$employee->height ?? '',['class' => 'form-control', 'placeholder' => '','required']) !!}
                            {!! $errors->first('height', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('national_id', "National ID Number",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('national_id',$employee->national_id ?? '',['class' => 'form-control', 'placeholder' => '','disabled']) !!}
                            {!! $errors->first('national_id', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('drivers_licence', "Drivers Licence",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('drivers_licence',$employee->drivers_licence ?? '',['class' => 'form-control', 'placeholder' => '','disabled']) !!}
                            {!! $errors->first('drivers_licence', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('passport_no', "Passport Number",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('passport_no',$employee->passport_no ?? '',['class' => 'form-control', 'placeholder' => '','disabled']) !!}
                            {!! $errors->first('passport_no', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-4">
                        <div class="form-group">
                            {!! Form::label('nssf_reg_no', "NSSF REG NUMBER",['class'=>'form-label','required_asterik']) !!}
                            {!! Form::text('nssf_reg_no',$employee->nssf_reg_no ?? '',['class' => 'form-control', 'placeholder' => '','disabled']) !!}
                            {!! $errors->first('nssf_reg_no', '<span class="badge badge-danger">:message</span>') !!}
                        </div>
                    </div>
                </div>
                &nbsp
                <div class="row">
                    <div class="col-12">
                        <div style="text-align: center;">
                            <button type="submit" class="btn btn-azure"  >Update Health Details </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    &nbsp;
    &nbsp;

    &nbsp
    &nbsp;
    <div class="col-lg-12 col-md-12">
        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Addresses</span>
                </div>

                <div class="card-options ">
                    <a href="{{route('person.address.create')}}"> <i class="fa fa-plus mr-2"></i>Add Address</a>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="all_addresses" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th class="wd-15p">#</th>
                            <th class="wd-15p">Address Type</th>
                            <th class="wd-15p">Region</th>
                            <th class="wd-20p">District</th>
                            <th class="wd-20p">Area</th>
                            <th class="wd-20p">House Number</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    &nbsp
    <div class="col-lg-12 col-md-12">
        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">Family</span>
                </div>

                <div class="card-options ">
                    <a href="{{route('person.family.create')}}"> <i class="fa fa-plus mr-2"></i>Add Members</a>
                </div>

            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="all_family" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th class="wd-15p">#</th>
                            <th class="wd-15p">Name</th>
                            <th class="wd-15p">Relationship</th>
                            <th class="wd-20p">Birth Date</th>
                            <th class="wd-20p">Phone</th>
                            <th class="wd-20p">Next of Kin</th>
                            <th class="wd-20p">Emergency Contact</th>
                            <th class="wd-20p">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>

        </div>
        {!! Form::close() !!}
    </div>



@endsection

@push('after-scripts')
    <script type="text/javascript">
        $(function () {
            $("#all_addresses").DataTable({
                processing: true,
                destroy:true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('person.datatable.address.all') }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'address_type', name: 'address_type', searchable: true},
                    {data: 'region', name: 'region', searchable: true},
                    {data: 'district', name: 'district', searchable: true},
                    {data: 'area_name', name: 'area_name', searchable: true},
                    {data: 'house_number', name: 'house_number', searchable: true},
                    {data: 'action', name: 'action', orderable: true, searchable: true},
                ]
            });

        });
        $(function () {
            $("#all_family").DataTable({
                processing: true,
                destroy:true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
                ajax: '{{ route('person.datatable.family.all') }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name', searchable: true},
                    {data: 'relationship', name: 'relationship', searchable: true},
                    {data: 'dob', name: 'dob', searchable: true},
                    {data: 'phone', name: 'phone', searchable: true},
                    {data: 'is_next_of_kin', name: 'is_next_of_kin', searchable: true},
                    {data: 'is_emergency', name: 'is_emergency', searchable: true},
                    {data: 'action', name: 'action', orderable: true, searchable: true},
                ]
            });

        });
    </script>
@endpush

