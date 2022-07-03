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
            <div class="form-group">
                <label class="form-label">Select selected candidate</label>

                {!! Form::open(['route' => 'job_offer.create','class'=>'card','method'=>'GET']) !!}
                <div class="input-group">
                    {!! Form::select('id', $applicant, null, ['class' =>'form-control select2 show-search custom-select', 'placeholder' => __('label.select') , 'aria-describedby' => '']) !!}
                    <span class="input-group-append">
													<button class="btn btn-primary" type="submit">Next <i class="fa fa-arrow-circle-o-right"></i></button>

												</span>
                </div>
                {!! Form::close() !!}
            </div>


        </div>
    </div>
@endsection
