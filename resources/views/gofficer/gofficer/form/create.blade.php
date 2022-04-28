@extends('layouts.app')
@section('content')

    <!-- Row-->
   @if($un_sync_g_officers->count()>0 || $uploaded_and_confirmed->count()>0)
       <div class="row">
           <div class="col-sm-12 col-md-6">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">Import Summary</h3>
                       <div class="card-options ">
                           <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                           <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                       </div>
                   </div>
                   <div class="card-body">
                       <ul class="list-group">
                           <li class="list-group-item justify-content-between">
                               Duplicate Entries
                               <span class="badgetext badge badge-danger badge-pill">{{$duplicate_entries->count()}}</span>
                           </li>
                           <li class="list-group-item justify-content-between">
                               Not Confirmed Entries
                               <span class="badgetext badge badge-warning badge-pill">{{$un_sync_g_officers->count()}}</span>
                           </li>
                           <li class="list-group-item justify-content-between">
                               Uploaded and Confirmed
                               <span class="badgetext badge badge-success badge-pill">{{$uploaded_and_confirmed->count()}}</span>
                           </li>
                       </ul>
                   </div>
               </div>
           </div>
           <div class="col-sm-12 col-md-6">
               <div class="card">
                   <div class="card-header">
                       <h3 class="card-title">Import Actions</h3>
                       <div class="card-options ">
                           <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                           <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                       </div>
                   </div>
                   <div class="card-body">
                       <a href="{{route('g_officer.confirm')}}" class="btn btn-indigo" onclick="confirm('Are you Sure you want to confirm the upload?')" > <i class="fe fe-check-circle mr-2"></i>Confirm and Import</a>
                       <a href="{{route('g_officer.export_duplicate')}}" class="btn btn-success" > <i class="fe fe-download-cloud mr-2"></i>Download Duplicates</a>
{{--                       <a href="{{route('g_officer.clear')}}" class="btn btn-instagram" onclick="confirm('Are you sure you want to clear import history?')" > <i class="fe fe-trash-2 mr-2"></i>Clear Import History</a>--}}

                   </div>
               </div>
           </div>
       </div>
       @endif
    <!-- End Row-->
{{--    <div class="row  mb-3">--}}
{{--        <span class="col-12 text-left font-weight-bold">Import Summary</span>--}}
{{--    </div>--}}
    {{--<div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="p-3">
                    <div class="row widget-text">
                        <div class="col-4">
                            <h3 class="mb-0">{{$duplicate_entries->count()}}</h3>
                            <p class=" mb-0 fs-13 text-muted">Duplicate Entries</p>
                        </div>
                        <div class="col-4">
                            <h3 class="mb-0">{{$un_sync_g_officers->count()}}</h3>
                            <span class=" mb-0 fs-13 text-muted">Not Confirmed Entries</span>
                        </div>
                        <div class="col-4">
                            <h3 class="mb-0">{{$uploaded_and_confirmed->count()}}</h3>
                            <span class=" mb-0  fs-13 text-muted">Uploaded and Confirmed</span>
                        </div>

                            <a href="{{route('g_officer.confirm')}}" class="btn btn-info" style="margin-left: 40%; margin-top: 2%"> <i class="fe fe-check-circle mr-2"></i>Confirm and Import</a>

                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    <div class="row  mb-3">
        <span class="col-12 text-left font-weight-bold">Individual External Users Registration</span>
    </div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        {!! Form::open(['route' => 'g_officer.store','class'=>'card']) !!}
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('first_name', __("label.name.first"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('first_name',old('first_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('first_name', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('middle_name', __("label.name.middle"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('middle_name',old('middle_name'),['class' => 'form-control', 'placeholder' => '']) !!}
                        {!! $errors->first('middle_name', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('last_name', __("label.name.last"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('last_name',old('last_name'),['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('last_name', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group ">
                        {!! Form::label('gender', __("label.gender"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('gender', $gender, null, ['class' =>'form-control select2 custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('gender', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        {!! Form::label('phone', __("label.phone"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::text('phone',null,['class' => 'form-control', 'placeholder' => '','required']) !!}
                        {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('g_scale', __("Title"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('g_scale', $g_scales, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('g_scale', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
       {{--         <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('regions', __("Region"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('region_id', $regions, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('region_id', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>--}}
                {!! Form::text('check_no',null,['class' => 'form-control', 'placeholder' => '','hidden']) !!}
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('district', __("District"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('district_id', $districts, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
                        {!! $errors->first('district_id', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('Facilities', __("Facilities"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('facilities[]', $facilities, null, ['class' =>'form-control select2-show-search', 'aria-describedby' => '','multiple']) !!}
                        {!! $errors->first('facilities', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>


                <button type="submit" class="btn btn-info" style="margin-left:45%;"><i class="fa fa-paper-plane mr-2"></i>Submit</button>

            </div>
        </div>

        {!! Form::close() !!}
        <div class="row  mb-3">
            <span class="col-12 text-left font-weight-bold">Bulk External Users Registration (Max 100 rows of data)</span>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
               {{-- <form action="{{ route('g_officer.import') }}" method="POST" enctype="multipart/form-data">
                <input type="file" class="dropify" data-height="180" name="file" />
                    <div class="row" style="margin-left: 45%">
                        <br>
                        <span class="text-gray text-small">(Max 100 rows)</span>
                        <br>
                        <br>

                    </div>
                    <div class="row" style="margin-left: 45%">
                        <button type="submit" class="btn btn-info"><i class="fe fe-upload mr-2"></i>Upload</button>
                    </div>
                        --}}{{--            <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>--}}{{--


                </form>--}}
                <form action="{{ route('g_officer.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="dropify">
                    <div class="row" style="margin-left: 43%">
                        <br>


                    </div>
                    <button class="btn btn-info" style="margin-left: 43%"><i class="fe fe-upload mr-2"></i>Upload User Data</button>
                    {{--            <a class="btn btn-warning" href="{{ route('export') }}">Export User Data</a>--}}
                </form>
            </div>

        </div>


</div>
@endsection
