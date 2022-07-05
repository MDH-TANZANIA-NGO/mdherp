@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create job offer</h3>
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                        <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="demo-accordion accordionjs m-0" data-active-index="false">

                        <!-- Section 1 -->
                        <li class="acc_section">
                            <div class="acc_head"><h3>{{$job_offer->interviewApplicant->applicant->full_name}}: <b>{{$job_offer->interviewApplicant->interviews->jobRequisition->designation->full_title}}</b></h3></div>
                            <div class="acc_content" style="display: none;"><p>{{$job_offer->interviewApplicant->interviews->jobRequisition->advertisment->description}}</p></div>
                        </li>

                    </ul>
                    <br>
                    {!! Form::open(['route' => ['job_offer.update',$job_offer->uuid], 'method'=>'PUT']) !!}
                    <input type="number" name="hr_hire_requisitions_job_applicants_id" value="3" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Salary amount</label>
                                <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-dollar-sign"></i>
												</span>
                                    <input type="text" class="form-control" name="salary" value="{{currency_converter($job_offer->salary, 'TSH')}}" placeholder="Salary Amount">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Date of arrival</label>
                                <div class="input-icon">
												<span class="input-icon-addon">
													<i class="fe fe-calendar"></i>
												</span>
                                    <input type="datetime-local" name="date_of_arrival" value="{{date('d/m/Y h:m:s',strtotime($job_offer->date_of_arrival))}}" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Other benefits</label>
                                <textarea class="content2 richText-initial" name="details" style="display: none;" value="{!! html_entity_decode($job_offer->details) !!}"></textarea>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="btn btn-instagram"><i class="fa fa-arrow-circle-left mr-2"></i>Back</a>
                    <button type="submit" class="btn btn-vk"><i class="fa fa-paper-plane-o mr-2"></i>Update</button>


                </div>
                {!! Form::close() !!}
            </div>
        </div>

@endsection
