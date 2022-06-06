@extends('layouts.app')
@section('content')
@if(isset($initiate))
@include('HumanResource.HireRequisition._parent.datatables.index')
@endif
<div class="panel panel-primary">
    <div class=" tab-menu-heading card-header sw-theme-dots">
        <div class="tabs-menu1">
            <!-- Tabs -->
            <ul class="nav panel-tabs step-anchor">
                <li><a href="#processing" class="active" data-toggle="tab">1.General</a></li>
                <li><a href="#returned" data-toggle="tab">2.Criteria</li>
            </ul>
			
        </div> 
		<div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
                <div class="btn-group mb-0">
                    <a href="requisitions/create"> <i class="fa fa-plus mr-2"></i>Create Request</a>
                </div>
            </div>
    </div>
    <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
        <div class="tab-content">
            @if(isset($initiate))
                <form action="{{route('hirerequisition.addRequisition',$uuid)}}" method="post">
            @else
                <form action="{{route('hirerequisition.store')}}" method="post">
            @endif
					@csrf
				<!-- Large Modal -->
				<div class="col-lg-12 col-md-12">
					<div class="row">
						<div class="col-lg-12">
							<ol class="breadcrumb1">
								<li class="breadcrumb-item1  h5"> General </li>
							</ol>
						</div>
					</div>
					<div class="row">
						<div class="col-6 col-lg-6">
							<label class="form-label">Department</label>
							<select name="department_id" id="select-department" data-placeholder="Select Department" class="form-control select2-show-search">
								<option></option>
								@foreach($departments as $department)
									<option value="{{$department->id}}">{{$department->title}}</option>
								@endforeach
							</select>
							@error('department_id')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
							@enderror
						</div>

						<div class="col-6 col-lg-6">
							<label class="form-label">Job Title</label>
							<select name="job_title" id="select-department" data-placeholder="select job title" class="form-control select2-show-search">
								<option></option>
								@foreach($designations as $designation)
									<option value="{{$designation->id}}">{{$designation->name}}</option>
								@endforeach
							</select>             
						</div>
					</div>
					<div class="row">
						<div class="col-6" >
							<label class="form-label">Number of Employees Required</label>
							<input type="number" class="form-control" name="empoyees_required" placeholder="ie. 1, 4" required>
							@error('number')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
							@enderror
						</div>

						<div class="col-6">
							<label class="form-label">Location</label>
							<select name="region[]" id="select-region" class="form-control select2-show-search" data-placeholder="select location" multiple>
								<option value="">Select Location</option>
								@foreach($regions as $region)
									<option value="{{$region->id}}">{{$region->name}}</option>
								@endforeach
							</select>
							@error('region_id')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
							@enderror
						</div>
					</div>
					<div class="row">
						<div class="col-12 col-lg-12" >
							<label class="form-label">Duties And Resposibilities</label>
							<textarea type="text" class="form-control" name="duties_and_responsibilities" placeholder="Duties and responsibilities here" required></textarea>
							@error('duties_and_responsibilities')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
							@enderror
						</div>						 
					</div>
 
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
						<li class="breadcrumb-item1 h5"> Person Requirement </li>
					</ol>
					<div class="row mt-2">
						<div class="col-12 ">
							<label class="form-label">Education</label>
							<textarea class="form-control summernotecontent " id = "education_and_qualification" name="education_and_qualification" rows="2" placeholder="Describe the requirements for education and qualifications for this post" required></textarea>
						</div>
						@error('education_and_qualification')
						<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
						@enderror
					</div>
        
					<div class="row mt-2">
						<div class="col-12">
							<label class="form-label">Practical Experience</label>
							<textarea class="form-control summernotecontent" name="practical_experience" rows="4" placeholder="Practical experience required for this post" required></textarea>
						</div>
						@error('practical_experience')
						<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
						@enderror
					</div>
					<div class="row mt-2">
						<div class="col-12">
							<label class="form-label">Other Special Qualities/Skills</label>
							<textarea class="form-control  summernotecontent" name="special_qualities_skills" rows="4" placeholder="Other Special Qualities or Skills" required></textarea>
						</div>
						@error('other_qualities')
						<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
						@enderror
					</div>
					<div class="row mt-2">
						<div class="col-12 ">
							<ol class="breadcrumb1">
								<li class="breadcrumb-item1 h5"> Employment Condition </li>
							</ol>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-6">
							<label class="form-label">Employment Condition</label>
							@foreach($contract_types as $contract_type)
								<label class="custom-control custom-radio">
									<input type="radio" class="custom-control-input" name="contract_type" value="{{$contract_type->id}}" checked>
									<span class="custom-control-label">{{$contract_type->name}}</span>
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
  
					<div class="row mt-2">
						<div class="col-6 col-lg-6">
							<label class="form-label">Establishment</label>
							<select name="establishment" id="select-establishment" class="form-control custom-select establishment select2" data-placeholder="Select Establishment">
								<option></option>
								@foreach($establishments as $establishment)
									<option value="{{$establishment->id}}">{{$establishment->name}}</option>
								@endforeach
							</select>
							@error('establishment_cv_id')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
							@enderror
							<div class="col-6 col-lg-6 budget" style="display: none">
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
							<div class="col-6 col-lg-6 employee mt-2" style="display: none">
								<label class="form-label">Staff to be replaced</label>
								<select name="employee_id" id="select-employee" data-placeholder="Select Staff to be replaced" class="form-control d-block select2-show-search" multiple>
									<option></option>
									@foreach($users as $user)
										<option value="{{$user->id}}">{{$user->fullName}}</option>
									@endforeach
								</select>
							</div>
						</div>


						<div class="col-6">
							<label class="form-label">Working Tools</label>
							<select name="tools[]" id="select-region"  style="width: 100%" class="form-control custom-select select2-show-search" data-placeholder="select working tool" multiple>
								<option>Select Working Tools</option>
								@foreach($tools as $tool)
									<option value="{{$tool->id}}">{{$tool->name}}</option>
								@endforeach
							</select>
							@error('tool_id')
							<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
							@enderror

						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6">
						   
						</div>
						<div class="col-6">
								<button type="submit" name="submit_job_requisition" value="save" class="btn btn-inline-block btn-success"> <i class="fa fa-save"></i> Save </button>
								<button type="submit" name="submit_job_requisition" value="add" class="btn btn-inline-block btn-azure"> <i class="fa fa-plus"></i> Add Requisition</button>
								
						</div>
					</div>
				</form>
			</div>
		</div>
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
            });
            $("#education").richText({ 
                preview: true,
                adaptiveHeight: true,
            });

            $('.summernotecontent').summernote({
                height: 140,
                spellCheck: true,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen']]
                ]
            });

        $(".money").maskMoney({
            precision: 2,
            allowZero: false,
            affixesStay: false,
            thousands: '',
        });
     

            // $(".practical_experience").richText();
            $(".other_qualities").richText();
            $(".education").richText();
        });

    </script>
    <style>

        .breadcrumb1{
            background-color:rgb(152, 186, 217);
            border-radius: 0;
        }

        .breadcrumb1 li{
          
            margin: 0;
        }

    </style>

@endpush




