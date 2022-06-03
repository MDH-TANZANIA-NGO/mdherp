@extends('layouts.app')
@section('content')




<div class="row flex-lg-nowrap">
    <div class="col-12 col-lg-3 mb-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Filter</h3>
            </div>
            <div class="card-body">

                {!! Form::open(['route' => 'g_officer.filter']) !!}


                        <div class="form-group ">
                            {!! Form::label('region', __("label.region"),['class'=>'form-label','required_asterik']) !!}
                            {!! Form::select('region', $regions, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required', 'style'=>'width:100%']) !!}
                            {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                        </div>

                        <div class="form-group ">
                            {!! Form::label('Districts', __("Districts"),['class'=>'form-label','required_asterik']) !!}
                            {{--                                        {!! Form::select('districts', $districts, null, ['class' =>'form-control select2-show-search', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required','style'=>'width:100%']) !!}--}}
                            <select name="districts" class="form-control select2-show-search" style="width: 100%">
                                <option value="">Select District</option>
                            </select>
                            {!! $errors->first('districts', '<span class="badge badge-danger">:message</span>') !!}
                        </div>

                    <button type="submit" class="btn btn-outline-success" style="margin-left: 30%"><i class="fa fa-file-excel-o"></i> Export Excel</button>


                {!! Form::close() !!}

            </div>
        </div>
    </div>
    <div class="col">
        <div class="row flex-lg-nowrap">
            <div class="col mb-3">
                <div class="e-panel card">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                        <div class="card-options ">
                            <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                            <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="e-table">
                            <div class="table-responsive table-lg mt-3">
                                to be displayed
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>
@endsection
@push('after-scripts')
    <script>
        $(document).ready(function(){
            $("select[name='region']").on('change',function(e){
                e.preventDefault();
                $('select[name="districts"]').empty();
                var region_id= $(this).val();
                var url = '{{ route("g_officer.getDistricts", ":id") }}';
                url = url.replace(':id', region_id);
                if (region_id) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        success: function(data){
                            $('select[name="districts"]option:not(:first)').remove();
                            $.each(data,function(key,value){
                                $('select[name="districts"]').append('<option value="">select district</option><option value="'+value.id+'">'+value.name+'</option>');
                            });
                        }
                    });
                }else {
                    $('select[name="districts"]').empty();
                }


            });


            $('select[name="districts"]').on('change',function(e){
                e.preventDefault();
                $('select[name="facilites"] option:not(:first)').remove();
                var district_id= $(this).val();
                var url = '{{ route("g_officer.getFacilities", ":id") }}';
                url = url.replace(':id', district_id);
                if (district_id) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        dataType: "json",
                        success: function(data){
                            $('select[name="facilities"]').empty();
                            $.each(data,function(key,value){
                                $('select[name="facilities"]').append('<option value="'+value.facility_id+'">'+value.facility_name+'</option>');
                            });
                        }
                    });
                }else {
                    $('select[name="facilities"]').empty();
                }
            });
        });
    </script>
@endpush
