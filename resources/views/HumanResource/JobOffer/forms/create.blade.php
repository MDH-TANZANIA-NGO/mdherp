@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Job Offer</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">
{{dd($applicant)}}
            <div class="form-group">
                <label class="form-label">Select selected candidate</label>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-append">
													<button class="btn btn-primary" type="button">Go!</button>
												</span>
                </div>
            </div>


        </div>
    </div>
@endsection
