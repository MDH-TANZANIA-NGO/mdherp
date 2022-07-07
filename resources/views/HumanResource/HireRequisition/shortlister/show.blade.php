@extends('layouts.app')
@section('content')

<div class="row mb-2">
    <div class="col-lg-12">
        @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
    </div>
</div>

<div class="align-content-center" style="background-color: rgb(238, 241, 248); height: 40px;">
        <div class="row text-center" style="font-size: large">
            <span class="col-12 text-center font-weight-bold" style="margin-top: 10px"><b>NUMBER.  {{ $job_shortlister_request->number }}</b></span>
        </div>
    </div>

@foreach($jobs as $job)
<div class="row mb-3">
    @include('HumanResource.HireRequisition.job._partials._job_description',['hire_requisition_job' => $job->job])

    <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
        {!! Form::open(['route' => ['job_shortlist_user.store', $job->id,$job->job->id] ]) !!}
        <div class="card">
            <div class="p-3">
                <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">

                    <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <th>#</th>
                            <th>Names</th>
                            <th>Designation</th>
                            <th>Region</th>
                        </thead>
                        <tbody>
                            @foreach(App\Models\HumanResource\HireRequisition\HrUserHireRequisitionJobShortlisterUser::where('hr_user_hire_requisition_job_shortlister_id',$job->id)->get() as $key => $job)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $job->user->fullname }}</td>
                                <td>{{ $job->user->designation_title }}</td>
                                <td>{{ $job->user->region->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

</div>
@endforeach


@endsection