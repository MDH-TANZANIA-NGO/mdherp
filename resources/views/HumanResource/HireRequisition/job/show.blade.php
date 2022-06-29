@extends('layouts.app')
@section('content')
<div class="row">

    <div class="col-xl-12 col-md-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="p-3">
                <h3 class="card-title mb-3">Shortlist Summary</h3>
                <div class="row widget-text">
                    <div class="col-4">
                        <h3 class="mb-0">{{ collect($applicants)->count() }}</h3>
                        <span class=" mb-0 fs-12 text-muted">All Applicants</span>
                    </div>
                    <div class="col-4 ">
                        <h3 class="mb-0">{{ $hire_requisition_job->shortlists()->count() }}</h3>
                        <span class=" mb-0 fs-12 text-muted">Shortlisted Applicants</span>
                    </div>
                    <div class="col-4 ">
                        <h3 class="mb-0">{{ collect($applicants)->count() - $hire_requisition_job->shortlists()->count() }}</h3>
                        <span class=" mb-0 fs-12 text-muted">Unselect Applicants</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

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



                            {{--<tr>
                                <td> skills</td>
                                <td>
                                    <ul class="ml-3" style="list-style-type: circle;">
                                        @foreach( $hire_requisition_job->skills as $skill)
                                        <li> {{ $skill->name }}
            </li>
            @endforeach
        </ul>
        </td>
        </tr>--}}


        </tbody>
        </table>


    </div>
    </li>
    </ul>
</div>

<div class="col-xl-12 col-md-12 col-md-12 col-lg-12 mt-5">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Applicants</h3>
        </div>
        <div class="card-body">
            <table id="applicants" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th class="wd-15p">#</th>
                        <th class="wd-15p">FIRST NAME</th>
                        <th class="wd-15p">MIDDLE NAME</th>
                        <th class="wd-15p">LAST NAME</th>
                        <th class="wd-15p">EMAIL</th>
                        <th class="wd-15p">MOBILE NUMBER</th>
                        <th class="wd-25p">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicants AS $key => $applicant)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $applicant->first_name }}</td>
                        <td>{{ $applicant->middle_name }}</td>
                        <td>{{ $applicant->last_name }}</td>
                        <td>{{ $applicant->email }}</td>
                        <td>{{ $applicant->phone }}</td>
                        <td><a href="#" data-toggle="modal" class="applicant_button">View More info</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Large Modal -->
    <div id="applicantModal" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Message Preview</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <h5 class=" lh-3 mg-b-20"><a href="" class="font-weight-bold">Why We Use Electoral College, Not Popular Vote</a></h5>
                    <p class="">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

</div>

</div>
@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {
        $("#applicants").DataTable();
        $(".applicant_button").click(function(event){
            event.preventDefault()
            $.ajax({
                    url: $url,
                    type: 'GET',
                    success: function (data) {
                        if(data){
                            $('#applicantModal').modal('show');
                        }
                    },
                    error: function (error) {
                        not2()
                    }
                });
        });
    })
</script>
@endpush