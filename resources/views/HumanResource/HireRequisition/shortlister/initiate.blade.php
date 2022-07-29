@extends('layouts.app')
@section('content')

{{-- $job_shortlister_request --}}
<div class="row">
    <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Info Message</strong>
            <hr class="message-inner-separator">
            <p>Kindly Add Shortlister list on each job.</p>
        </div>
    </div>

    <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
        <a href="{{ route('job_shortlister.submit',$job_shortlister_request) }}" class="btn btn-primary pull-right">Submit for approval</a>
    </div>
</div>

@foreach($jobs as $job)
<div class="row">
    @include('HumanResource.HireRequisition.job._partials._job_description',['hire_requisition_job' => $job->job])

    <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
        {!! Form::open(['route' => ['job_shortlist_user.store',$job->id,$job->job->id] ]) !!}
        <div class="card">
            <div class="p-3">
                <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
                    <div class="form-group ">
                        {!! Form::label('users[]', __("SELECT ONE OR MULTIPLE SHORTLISTER"),['class'=>'form-label','required_asterik']) !!}
                        {!! Form::select('users[]', $users,
                        App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterUser::where('hr_user_hire_requisition_job_shortlister_id',$job->id)->pluck('user_id')
                        , ['class' =>'form-control select2-show-search' , 'aria-describedby' => '','multiple', 'required']) !!}
                        {!! $errors->first('users[]', '<span class="badge badge-danger">:message</span>') !!}
                    </div>
                </div>
                <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
                    <div class="form-group ">
                        {!! Form::submit('Add',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

</div>
@endforeach

@endsection