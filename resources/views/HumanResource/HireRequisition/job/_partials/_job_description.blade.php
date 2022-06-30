<div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
    <ul class="demo-accordion accordionjs m-0" data-active-index="false">
        <li class="acc_section">
            <div class="acc_head">
                <h3>{{ $hire_requisition_job->designation->full_title }} ( Number of Employees Required: {{ $hire_requisition_job->empoyees_required }} )</h3>
            </div>
            <div class="acc_content" style="display: none; background-color:#fff">


                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td> <strong>Department: </strong></td>
                            <td> {{ $hire_requisition_job->department->title }} </td>
                        </tr>
                        <tr>
                            <td><strong>Number of Employees Required: </strong></td>
                            <td>{{ $hire_requisition_job->empoyees_required }}</td>
                        </tr>
                        <tr>
                            <td><strong>Location: </strong></td>
                            <td>
                                @foreach($hire_requisition_job->locations as $location)
                                {{ $location->region->name }},
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Date Required : </strong></td>
                            <td>{{ $hire_requisition_job->date_required }}</td>
                        </tr>
                        <tr class="gray">
                            <td colspan="2">
                                <h5 class="text-uppercase">Person Required </h5>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Education and Qualification: </strong></td>
                            <td> {!! $hire_requisition_job->education_and_qualification !!}</td>
                        </tr>
                        <tr>

                            <td><strong>Practical Experience: </strong></td>
                            <td> {!! $hire_requisition_job->practical_experience !!}</td>
                        </tr>
                        <tr>
                            <td><strong>Other Special Qualities / Skills: </strong></td>
                            <td> {!! $hire_requisition_job->special_qualities_skills !!} </td>
                        </tr>
                        <tr class="gray">
                            <td colspan="2" class="text-uppercase">
                                <h5> Employement Condition </h5>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Prospect for appointment : </strong></td>
                            <td> {!! $hire_requisition_job->contract_type !!} </td>
                        </tr>
                        <tr>
                            <td><strong>Special Employment Condition : </strong></td>
                            <td> {!! $hire_requisition_job->special_employment_condition !!} </td>
                        </tr>
                        </tr>
                        <tr>
                            <td><strong> Establishment : </strong></td>
                            <td> {{ $hire_requisition_job->establishment }} </td>
                        </tr>
                        <tr>
                            <td><strong> Working Tools : </strong></td>
                            <td>
                                {{ $hire_requisition_job->working_tools }}
                            </td>
                        </tr>
                        <tr class="gray">
                            <td colspan="2" class="text-uppercase">
                                <h5> Criteria </h5>
                            </td>
                        </tr>
                        <tr>


                        </tr>


                        <tr>
                            <td> Education Level </td>
                            <td> {{ $hire_requisition_job->education_level }}</td>
                        </tr>
                        <tr>
                            <td> Years Of Experience </td>
                            <td> {{ $hire_requisition_job->experience_years }}</td>
                        </tr>
                        <tr>
                            <td> Age Between</td>
                            <td> {{ $hire_requisition_job->start_age}} And {{ $hire_requisition_job->start_age }}</td>
                        </tr>

                    </tbody>
                </table>


            </div>
        </li>
    </ul>
</div>