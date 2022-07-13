@extends('layouts.app')
@section('content')

<div class="row mb-2">
    <div class="col-lg-12">
        @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
    </div>
</div>

<div class="align-content-center" style="background-color: rgb(238, 241, 248); height: 40px;">
    <div class="row text-center" style="font-size: large">
        <span class="col-12 text-center font-weight-bold" style="margin-top: 10px"><b>NUMBER. {{ $hr_hire_job_app_request->number }}</b></span>
    </div>
</div>

@foreach($jobs as $job)
<div class="row mb-3">

    <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
        <ul class="demo-accordion accordionjs m-0" data-active-index="false">
            <li class="acc_section">
                <div class="acc_head">
                    <h3>{{ $job->job_title }} ( Number of Employees Required: {{ $job->empoyees_required }} )</h3>
                </div>
                <div class="acc_content" style="display: none; background-color:#fff">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td> <strong>Department: </strong></td>
                                <td> {{ $job->department }} </td>
                            </tr>
                            <tr>
                                <td><strong>Education and Qualification: </strong></td>
                                <td> {!! $job->education_and_qualification !!}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>Shortlisted Applicants</h4>
                    <table id="applicants" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-15p">#</th>
                        <th class="wd-15p">FIRST NAME</th>
                        <th class="wd-15p">MIDDLE NAME</th>
                        <th class="wd-15p">LAST NAME</th>
                        <th class="wd-15p">EMAIL</th>
                        <th class="wd-15p">MOBILE NUMBER</th>
                        <th class="wd-15p">STATUS</th>
                        <th class="wd-15p">SHORTLISTED BY</th>
                        <th class="wd-25p">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\HumanResource\HireRequisition\HrHireRequisitionJobApplicant::where('hr_hire_requisitions_job_id', $job->id)->first() AS $key => $hr_job)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $hr_job->applicant->first_name }}</td>
                        <td>{{ $hr_job->applicant->middle_name }}</td>
                        <td>{{ $hr_job->applicant->last_name }}</td>
                        <td>{{ $hr_job->applicant->email }}</td>
                        <td>{{ $hr_job->applicant->phone }}</td>
                        <td>
                            {{ is_shortlisted($hr_job->applicant->id, $hr_job->id) ? 'Not Shortlisted' : 'Shortlisted' }}
                        </td>
                        <td>
                            {{ is_shortlisted($hr_job->applicant->id, $hr_job->id) ? '' : shortlister_details($hr_job->applicant->id, $hr_job->id) }}
                        </td>
                        <td><a href="{{ route('hr.job.show_more',[$hr_job->uuid,$hr_job->applicant->id]) }}">View More info</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
            </li>
        </ul>
    </div>

    {{-- <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
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
    </div> --}}

</div>
@endforeach


@endsection