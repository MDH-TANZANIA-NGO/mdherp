@extends('layouts.app')

@section('content')
@if($job_details == null)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form elements</h3>
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group">

                        <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-user"></i>
												</span>
                            <input type="text" class="form-control" placeholder="Username">
                        </div>
                    </div>


            </div>
        </div>
    </div>
    @endif
@endsection
