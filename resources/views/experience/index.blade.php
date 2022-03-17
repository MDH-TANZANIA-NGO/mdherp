@extends('layouts.app')
@section('content')
    <form action="{{route('experience.store')}}" method="post">
    @csrf
    <!-- Large Modal -->
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: rgb(238, 241, 248)">
                    <div class="row text-center">
                        <span class="col-12 text-center font-weight-bold">Practical Experience</span>
                    </div>

                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" >
                            <label class="form-label">Organisation/Company Name</label>
                            <input class="form-control" name="organisation_name" placeholder="Name of the Organisation or Company" required></input>
                            @error('organisation_name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-md-6" >
                            <label class="form-label">Position Held</label>
                            <input class="form-control" name="position" placeholder="Your position in the Organisation or Company" required></input>
                            @error('position')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                    </div>
                    &nbsp;
                    <div class="row">
                        <div class="col-md-6" >
                            <label class="form-label">Summary of duties performed</label>
                            <textarea class="form-control" name="summary" rows="2" placeholder="Summary of duties" required></textarea>
                            @error('summary')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>

                        <div class="col-md-6" >
                            <label class="form-label">Supervisor</label>
                            <textarea class="form-control" name="supervisor" rows="2" placeholder="Supervisor details (comma separated)" required></textarea>
                            @error('supervisor')
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
                                </div><input class="form-control" name="start_year" placeholder="MM/DD/YYYY" type="date" required>
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
                                </div><input class="form-control" name="end_year" placeholder="MM/DD/YYYY" type="date">
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
                                <button type="submit" class="btn btn-azure"> Add Practical Experience Details</button>
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
                    <span class="col-12 text-center font-weight-bold">List of Practical Experiences</span>
                </div>

                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                </div>

            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-12" >

                        <div class="table-responsive">
                            @include('experience.datatables.all')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
