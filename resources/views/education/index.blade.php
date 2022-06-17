@extends('layouts.app')
@section('content')
    <form action="{{route('education.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Large Modal -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <div class="row text-center">
                        <span class="col-12 text-center font-weight-bold">Academic Details</span>
                    </div>

                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4" >
                            <label class="form-label">Education Level</label>
                            <select name="education_level_cv_id" id="select-level" class="form-control custom-select">
                                <option value=""  disabled selected hidden>Select Level</option>
                                @foreach($educations as $education)
                                    <option value="{{ $education->id }}">{{$education->name}}</option>
                                @endforeach
                            </select>
                            @error('education_level_cv_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-md-8" >
                            <label class="form-label">Institution</label>
                            <textarea class="form-control" name="institution_name" rows="2" placeholder="Name of the Institution" required></textarea>
                            @error('institution_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>
                    &nbsp;
                    <div class="row">
                        <div class="col-md-6" >
                            <label class="form-label">Course</label>
                            <textarea class="form-control" name="award_received" rows="2" placeholder="Enter the course you study" required></textarea>
                            @error('award_received')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-md-6" >
                            <label class="form-label">Upload Certificate</label>
                            <input type="file" class="form-control" name="certificate" placeholder="Enter the course you study" required></input>
                            @error('certificate')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>
                    &nbsp;
                    <div class="row">
                        <div class="col-md-6" >
                            <label class="form-label">Start Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" name="start_year" placeholder="MM/DD/YYYY" type="date" required>
                            </div>
                            @error('start_year')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                        <div class="col-md-6" >
                            <label class="form-label">End Date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div>
                                </div><input class="form-control fc-datepicker" name="end_year" placeholder="MM/DD/YYYY" type="date" required>
                            </div>
                            @error('end_year')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                    </div>

                    &nbsp
                    &nbsp;
                    <div class="row">

                        <div class="col-12">
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-azure"> Add Academic Details</button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </form>


    <div class="col-lg-12 col-md-12">

        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">List of Academic Qualification</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>

            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-12" >

                        <div class="table-responsive">
                            @include('education.datatables.all')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
