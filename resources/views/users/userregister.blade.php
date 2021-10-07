@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Register New User</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Enter First Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="First Name">
                </div>

                <div class="form-group">
                        <label class="form-label">Enter Last Name</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                </div>

                <div class="form-group ">
                    <label class="form-label">Choose Gender</label>
                    <select class="form-control select2 custom-select select2-hidden-accessible" data-placeholder="Choose one" tabindex="-1" aria-hidden="true">
                        <option label="Choose one">
                        </option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                        
                    </select>
                </div>

                

                <div class="form-group">
                    <label class="form-label">Enter Phone Number </label>
                    <input type="number" class="form-control" name="phone" placeholder="i.e 0653000000">
                </div>

                <div class="form-group">
                    <label class="form-label">Valid Email</label>
                    <input type="text" class="form-control is-valid state-valid" name="email" placeholder="example@mdh.or.tz">
                </div>

                <div class="form-group ">
                    <label class="form-label">Enter Designation</label>
                    <select class="form-control select2 custom-select select2-hidden-accessible" data-placeholder="Choose one" tabindex="-1" aria-hidden="true">
                        <option label="Choose one">
                        </option>
                        <option value="1">HR manager</option>
                        <option value="2">Health Informatics</option>
                        <option value="2">Software Developer</option>
                        
                    </select>
                </div>

                
                <div class="form-group">
                    <label class="form-label">Enter Hired Date</label>
                    <input type="date" class="form-control" name="employed_date" placeholder="">
                </div>

                <div class="btn-list text-right">
                    <a href="#" class="btn btn-primary">Register</a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
