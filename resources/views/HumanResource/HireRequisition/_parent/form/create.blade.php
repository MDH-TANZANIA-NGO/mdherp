@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
    <div class=" tab-menu-heading card-header sw-theme-dots" style="background-color: rgb(238, 241, 248)">
        <div class="tabs-menu1">
            <!-- Tabs -->
            <ul class="nav panel-tabs step-anchor">
                <li><a href="#processing" class="active" data-toggle="tab">1.General</a></li>
                <li><a href="#returned" data-toggle="tab">2.Criteria</li>
            </ul>
        </div>

        <div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
            <div class="btn-group mb-0">
                <a href="{{ route('hirerequisition.create') }}"> <i class="fa fa-plus mr-2"></i>Create Request</a>
            </div>
        </div>
    </div>
    <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
        <div class="tab-content">
        <form action="{{route('hirerequisition.store')}}" method="post">
            @csrf
        <!-- Large Modal -->
        <div class="col-lg-12 col-md-12">
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1 active">General</li>
            </ol>
            <div class="row">
                <div class="col-6" >
                    <label class="form-label">Department</label>
                    <select name="department_id" id="select-department" class="form-control custom-select"  >
                        <option value=""  disabled selected hidden>Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->title}}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="form-label">Job Title</label>
                    <input type="text" class="form-control" name="title" placeholder="ie. Senior Lab Technician" required>
                    @error('title')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-6" >
                    <label class="form-label">Number of Employees</label>
                    <input type="number" class="form-control" name="number" placeholder="ie. 1, 4" required>
                    @error('number')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="form-label">Location</label>
                    <select name="region_id" id="select-region" class="form-control custom-select">
                        <option value=""  disabled selected hidden>Select Location</option>
                        @foreach($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                        @endforeach
                    </select>
                    @error('region_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>
            &nbsp;
            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Content</label>
                    <textarea class="form-control" name="content" rows="4" placeholder="Paste job description here (markdown is ok!)" required></textarea>
                </div>
                @error('content')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>
            &nbsp;

            <div class="row">
                <div class="col-6">
                    <label class="form-label">Date Required</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" name="date_required" placeholder="MM/DD/YYYY" type="date">
                    </div>
                    @error('date_required')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>

                <div class="col-6">
                    <label class="form-label">Prospect for appointment</label>
                    @foreach($prospects as $prospect)
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="prospect_for_appointment_cv_id" value="{{$prospect->id}}" checked>
                            <span class="custom-control-label">{{$prospect->name}}</span>
                        </label>
                    @endforeach
                    @error('prospect_for_appointment_cv_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
            </div>
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1 active"> Person Requirement </li>
            </ol>
            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Education</label>
                    <textarea class="form-control" name="education_and_qualification" rows="3" placeholder="Describe the requirements for education and qualifications for this post" required></textarea>
                </div>
                @error('education_and_qualification')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>
        
            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Practical Experience</label>
                    <textarea class="form-control" name="practical_experience" rows="4" placeholder="Practical experience required for this post" required></textarea>
                </div>
                @error('practical_experience')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>
            &nbsp;
            <div class="row">
                <div class="col-12 mt-1">
                    <label class="form-label">Other Special Qualities/Skills</label>
                    <textarea class="form-control" name="other_qualities" rows="4" placeholder="Other Special Qualities or Skills" required></textarea>
                </div>
                @error('other_qualities')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror
            </div>
           
            <ol class="breadcrumb1">
                <li class="breadcrumb-item1 active">  Employment Condition </li>
            </ol>
            <div class="row">
                <div class="col-6">
                    <label class="form-label">Employment Condition</label>
                    @foreach($conditions as $condition)
                        <label class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" name="employment_condition_cv_id" value="{{$condition->id}}" checked>
                            <span class="custom-control-label">{{$condition->name}}</span>
                        </label>
                    @endforeach
                    @error('employment_condition_cv_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>
                <div class="col-6">
                    <label class="form-label">Explain any Special Employment Condition</label>
                    <textarea class="form-control" name="special_employment_condition" rows="2" placeholder="Explain any Special Employment Condition" required></textarea>
                </div>
                @error('special_employment_condition')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                @enderror

            </div>
  
            <div class="row">
                <div class="col-6">
                    <label class="form-label">Establishment</label>
                    <select name="establishment_cv_id" id="select-establishment" class="form-control custom-select establishment">
                        <option value=""  disabled selected hidden>Select Establishment</option>
                        @foreach($establishments as $establishment)
                            <option value="{{$establishment->id}}">{{$establishment->name}}</option>
                        @endforeach
                    </select>
                    @error('establishment_cv_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                    <div class="col-6 budget" style="display: none">
                        <div class="form-label">Is there a budget for this position?</div>
                        <div class="custom-controls-stacked">
                            <label class="custom-control  custom-radio">
                                <input type="radio" class="custom-control-input" name="budget" value=1>
                                <span class="custom-control-label">Yes</span>
                            </label>
                            <label class="custom-control  custom-radio">
                                <input type="radio" class="custom-control-input" name="budget" value=0>
                                <span class="custom-control-label">No</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-6 employee mt-2" style="display: none">
                        <label class="form-label">Staff to be replaced</label>
                        <select name="employee_id" id="select-employee" class="form-control custom-select">
                            <option value=""  disabled selected hidden>Select Staff to be replaced </option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->fullName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="col-6">
                    <div class="form-label">Working Tools</div>
                    <div class="custom-controls-stacked">
                        @foreach($tools as $tool)
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="tools[]" value="{{ $tool->id}}">
                                <span class="custom-control-label">{{ $tool->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-success"> Save </button>
                        <button type="submit" class="btn btn-azure"> Add </button>
                        <button type="submit" class="btn btn-azure"> Next </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function (){
            $(document).on('change', '.establishment', function (){
                if($(this).val() == 23){
                    $('.budget').show()
                    $('.employee').hide()
                }
                if ($(this).val() == 22){
                    $('.employee').show()
                    $('.budget').hide()
                }
            })
        })

    </script>

@endpush




