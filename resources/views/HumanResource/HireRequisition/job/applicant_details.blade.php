@extends('layouts.app')
@section('content')
<div class="row">
    @include('HumanResource.HireRequisition.job._partials._shortlist_summary')
    @include('HumanResource.HireRequisition.job._partials._job_description')

    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">APPLICANT DETAILS</h3>
                <div class="card-options ">
                    <a href="{{ route('hr.job.application.shortlist',[$hire_requisition_job->id, $applicant->id]) }}" class="btn btn-primary" onclick='if(confirm("Are you sure you want to shortlist {{ $personal_info->first_name}} {{ $personal_info->middle_name}} {{ $personal_info->last_name }}")){ return true; } else { return false; }'>Click here to Shortlist this Applicant</a>
                    <a href="#" class="btn btn-danger" onclick='if(confirm("Are you sure you want to remove applicant shortlist {{ $personal_info->first_name}} {{ $personal_info->middle_name}} {{ $personal_info->last_name }}")){ return true; } else { return false; }'>Click here to Remove this Applicant From Shortlist</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>CV and COVER LETTER</strong></td>
                            <td>
                                <table style="width: 100%;">
                                    <tbody>
                                        <td><a style="text-decoration: underline; color:blue" href="{{ $attachment->cv }}">Curculum Vitae</a></td>
                                        <td><a style="text-decoration: underline; color:blue" href="{{ $attachment->cover_letters }}">Cover Letter</a></td>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td> <strong>PERSONAL INFORMATION </strong></td>
                            <td>
                                <span style="margin-right: 10px"><b>NAME:</b> {{ $personal_info->first_name." ".$personal_info->middle_name." ".$personal_info->last_name}}</span>
                                <span style="margin-right: 10px"><b>GENDER:</b> {{ $personal_info->gender }}</span>
                                <span style="margin-right: 10px"><b>DOB:</b> {{ $personal_info->dob }}</span>
                                <span style="margin-right: 10px"><b>EMAIL:</b> {{ $personal_info->email }}</span>
                                <span style="margin-right: 10px"><b>MOBILE NUMBER:</b> {{ $personal_info->phone }}</span>
                                <span style="margin-right: 10px"><b>NATIONAL ID NO:</b> {{ $personal_info->national }}</span>
                                <span style="margin-right: 10px"><b>COUNTRY:</b> {{ $personal_info->country }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ACADEMIC HISTORY: </strong></td>
                            <td>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>INSTITUTE/SCHOOL/UNIVERSITY</th>
                                            <th>AWARD RECEIVED</th>
                                            <th>START YEAR</th>
                                            <th>END YEAR</th>
                                            <th>STUDYING STATUS</th>
                                            <th>CERTIFICATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($educations AS $key => $education)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $education->institution_name }}</td>
                                            <td style="width: 10%;">{{ $education->award_received }}</td>
                                            <td style="width: 10%;">{{ $education->start_year }}</td>
                                            <td>{{ $education->end_year }}</td>
                                            <td>{{ $education->still_studying ? 'Completed' : 'still studying' }}</td>
                                            <td><a href="{{ $education->certificate}}">View</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ADDRESS: </strong></td>
                            <td>
                                <table style="width:100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>TYPE</th>
                                            <th>AREA NAME</th>
                                            <th>HOUSE NUMBER</th>
                                            <th>DISTRICT</th>
                                            <th>REGION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($addresses AS $key => $address)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $address->address_type }}</td>
                                            <td>{{ $address->area_name }}</td>
                                            <td>{{ $address->house_number }}</td>
                                            <td>{{ $address->district }}</td>
                                            <td>{{ $address->region }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>EXPERIENCES: </strong></td>
                            <td>
                                <table style="width:100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>ORGANISATION NAME</th>
                                            <th>POSITION</th>
                                            <th>RESPONSIBILITIES</th>
                                            <th>REASON FOR LEAVING</th>
                                            <th>SUPERVISOR INFO</th>
                                            <th>START YEAR</th>
                                            <th>END YEAR</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($experiences AS $key => $experience)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $experience->organisation_name }}</td>
                                            <td>{{ $experience->position }}</td>
                                            <td>{{ $experience->responsibilities }}</td>
                                            <td>{{ $experience->reason_for_leaving }}</td>
                                            <td>NAME : {{ $experience->supervisor_name }}, EMAIL: {{ $experience->supervisor_email }}, MOBILE: {{ $experience->supervisor_phone }}</td>
                                            <td>{{ $experience->start_year }}</td>
                                            <td>{{ $experience->end_year }}</td>
                                            <td>{{ $experience->is_current ? 'Still working' : '' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>SKILLS: </strong></td>
                            <td>
                                <table style="width:100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>CATEGORY</th>
                                            <th>SKILL</th>
                                            <th>LEVEL</th>
                                            <th>REMARKS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($skills AS $key => $skill)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $skill->category }}</td>
                                            <td>{{ $skill->skill }}</td>
                                            <td>{{ $skill->level }}</td>
                                            <td>{{ $skill->remarks }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>REFEREES: </strong></td>
                            <td>
                                <table style="width:100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr style="font-weight: bolder;">
                                            <th>#</th>
                                            <th>NAME</th>
                                            <th>GENDER</th>
                                            <th>ORGANISATION</th>
                                            <th>POSITION</th>
                                            <th>EMAIL</th>
                                            <th>ADDRESS</th>
                                            <th>TYPE</th>
                                            <th>REGION</th>
                                            <th>COUNTRY</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($referees AS $key => $referee)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $referee->name }}</td>
                                            <td>{{ $referee->gender }}</td>
                                            <td>{{ $referee->organisation_name }}</td>
                                            <td>{{ $referee->position }}</td>
                                            <td>{{ $referee->email }}</td>
                                            <td>{{ $referee->address }}</td>
                                            <td>{{ $referee->reference_type }}</td>
                                            <td>{{ $referee->region }}</td>
                                            <td>{{ $referee->country }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {
        $("#applicants").DataTable();
    })
</script>
@endpush
