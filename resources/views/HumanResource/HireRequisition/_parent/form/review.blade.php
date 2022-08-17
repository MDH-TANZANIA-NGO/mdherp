@extends('layouts.app')
@section('content')
@include('HumanResource.HireRequisition._parent.form.step_header')

<!-- Section 1 -->
<form action="{{ route('hirerequisition.steps.finish',$hireRequisition->uuid) }}" method="get">
<li class="">
    <div class="acc_content">
        <table class="table table-bordered active">
            <thead>
                <tr>
                    <th colspan="2" class="text-uppercase">
                        <h5 class="text-uppercase"> Job Title : {{$hireRequisitionJob->job_title}} </h5>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="gray">
                    <td colspan="2">
                        <h5 class="text-uppercase"> General Details </h5>
                    </td>
                </tr>
                <tr>
                    <td> <strong>Department: </strong></td>
                    <td> {{ $hireRequisitionJob->department->title }} </td>
                </tr>
                <tr>
                    <td><strong>Number of Employees Required: </strong></td>
                    <td>{{ $hireRequisitionJob->empoyees_required }}</td>
                </tr>
                <tr>
                    <td><strong>Location: </strong></td>
                    <td> {{ $regions }}
                    </td>
                </tr>
                <tr>
                    <td><strong>Date Required : </strong></td>
                    <td>{{ $hireRequisitionJob->date_required }}</td>
                </tr>

                <tr>
                    <td><strong>Position Summary : </strong></td>
                    <td>{!! $hireRequisitionJob->possition_summary !!}</td>
                </tr>
                 <tr>
                    <td><strong>Duties And Resposibilities: </strong></td>
                    <td>{!! $hireRequisitionJob->duties_and_responsibilities !!}</td>
                </tr>
                <tr class="gray">
                    <td colspan="2">
                        <h5 class="text-uppercase">Person Required </h5>
                    </td>
                </tr>
                <tr>
                    <td><strong>Education and Qualification: </strong></td>
                    <td> {!! $hireRequisitionJob->education_and_qualification !!}</td>
                </tr>
                <tr>
                    <td><strong>Practical Experience: </strong></td>
                    <td> {!! $hireRequisitionJob->practical_experience !!}</td>
                </tr>
                <tr>
                    <td><strong>Other Special Qualities / Skills: </strong></td>
                    <td> {!! $hireRequisitionJob->special_qualities_skills !!} </td>
                </tr>
                <tr class="gray">
                    <td colspan="2" class="text-uppercase">
                        <h5> Employment Condition </h5>
                    </td>
                </tr>
                <tr>
                    <td><strong>Prospect for appointment : </strong></td>
                    <td> {{ $appointment_prospect->name }} </td>
                </tr>
                <tr>
                    <td><strong>Special Employment Condition : </strong></td>
                    <td> {!! $hireRequisitionJob->special_employment_condition !!} </td>
                </tr>
                <tr>
                    <td><strong> Establishment : </strong></td>
                    <td> {{ $establishment->name }} </td>
                </tr>
                <tr>
                    <td><strong> Working Tools : </strong></td>
                    <td>
                        {{ $working_tools }}
                    </td>
                </tr>
                <tr class="gray">
                    <td colspan="2" class="text-uppercase">
                        <h5> Criteria </h5>
                    </td>
                </tr>
                <tr>
                    <td> Education Level </td>
                    <td> {{ isset($_education_level->name) ? $_education_level->name : " "  }}</td>
                </tr>
                <tr>
                    <td> Years Of Experience </td>
                    <td> {{ $hireRequisitionJob->experience_years }}</td>
                </tr>
                <tr>
                    <td> Age Between</td>
                    <td> {{ $hireRequisitionJob->start_age}} And {{ $hireRequisitionJob->end_age }}</td>
                </tr>
                <tr>
                    <td> skills</td>
                    <td>
                        <ul class="ml-3" style="list-style-type: circle;">
                            @foreach( $skills as $skill)
                            <li> {{ $skill->name }} </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</li>

<div class="row mt-3">
	<div class="col-6">
	</div>
	<div class="col-6">
		@if(!isset($create))
		<button id="" type="button" name="submit_job_requisition" value="Cancel" class="btn btn-inline-block btn-danger cancel"> <i class="fa fa-times"></i> Cancel </button>
		@endif
		<button type="button" class="btn btn-inline-block btn-azure prev-step"> <i class="fa fa-angle-left"></i> Back </button>
		<button type="submit" class="btn btn-inline-block btn-azure"> <i class="fa fa-save"></i> Finish</button>
	</div>
</div>
</form>
<!-- Modal -->
@include('HumanResource.HireRequisition._parent.form.step_footer')
@endsection('content')
