@extends('layouts.app')
@section('content')
<div class="panel panel-primary">
	<div class=" tab-menu-heading card-header sw-theme-dots">
		<div class="tabs-menu1">
			<!-- Tabs -->
			<ul class="nav panel-tabs">
				<li class="nav-item"><a href="#processing" class="nav-link active" data-toggle="tab">1.General</a></li>
				<li class="nav-item"><a href="#returned" class="nav-link disabled" data-toggle="tab">2.Criteria</a></li>
			</ul>
		</div>
		<div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
		</div>
	</div>
	<div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
		<div class="tab-content">
			<div class="tab-pane active" id="processing">
				@if(isset($initiate))
				<form action="{{route('hirerequisition.addRequisition',$uuid)}}" method="post">
					@else
					<form action="{{route('hirerequisition.update',$hireRequisitionJobs->id )}}" method="post">
						@endif
						@csrf
						@method('put')
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

										<option {{  $hireRequisitionJobs->department_id == $department->id ? 'selected':''  }} value="{{$department->id}}">{{$department->title}}</option>
										@endforeach
									</select>
									@error('department_id')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
									@enderror
								</div>

								<div class="col-6 col-lg-6">
									<label class="form-label">Job Title</label>
									{!! Form::select('job_title',$designations,$hireRequisitionJobs->designation_id ,['class' => 'form-control select2', 'placeholder'=>'Select Job','required']) !!}
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<label class="form-label">Number of Employees Required</label>
									<input type="number" value="{{$hireRequisitionJobs->empoyees_required }}" class="form-control" name="empoyees_required" placeholder="ie. 1, 4" required>
									@error('number')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
									@enderror
								</div>
								<div class="col-6">
									<label class="form-label">Location</label>
									<select name="region[]" id="select-region" class="form-control select2-show-search" data-placeholder="select location" multiple>
										<option value="">Select Location</option>
										@foreach($regions as $region)
										<option {{ is_array($current_regions) && in_array($region->id,$current_regions ) ? 'selected' : '' }} value="{{$region->id}}"> {{$region->name}}</option>
										@endforeach
									</select>
									@error('region_id')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
									@enderror
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-lg-12">
									<label class="form-label">Duties And Resposibilities</label>
									<textarea type="text" class="form-control summernotecontent" name="duties_and_responsibilities" placeholder="Duties and responsibilities here" required>{{ $hireRequisitionJobs->duties_and_responsibilities }}</textarea>
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
										</div><input class="form-control" value="{{ $hireRequisitionJobs->date_required }}" name="date_required" placeholder="MM/DD/YYYY" type="date">
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
									<label class="form-label">Education And Qualification</label>
									<textarea class="form-control summernotecontent " id="education_and_qualification" name="education_and_qualification" rows="2" placeholder="Describe the requirements for education and qualifications for this post" required>{{ $hireRequisitionJobs->education_and_qualification }}</textarea>
								</div>
								@error('education_and_qualification')
								<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
								@enderror
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<label class="form-label">Practical Experience</label>
									<textarea class="form-control summernotecontent" name="practical_experience" rows="4" placeholder="Practical experience required for this post" required>{{ $hireRequisitionJobs->practical_experience }}</textarea>
								</div>
								@error('practical_experience')
								<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
								@enderror
							</div>
							<div class="row mt-2">
								<div class="col-12">
									<label class="form-label">Other Special Qualities/Skills</label>
									<textarea class="form-control  summernotecontent" name="special_qualities_skills" rows="4" placeholder="Other Special Qualities or Skills" required>{{ $hireRequisitionJobs->special_qualities_skills }}</textarea>
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
										<input type="radio" {{ isset($hireRequisitionJobs->hr_contract_type_id) && $hireRequisitionJobs->hr_contract_type_id == $contract_type->id ? 'selected' : '' }} class="custom-control-input" name="contract_type" value="{{$contract_type->id}}" checked>
										<span class="custom-control-label">{{$contract_type->name}}</span>
									</label>
									@endforeach
									@error('employment_condition_cv_id')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
									@enderror
								</div>
								@error('special_employment_condition')
								<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
								@enderror
							</div>
							<div class="row">
								<div class="col-lg-12">
									<label class="form-label">Explain any Special Employment Condition</label>
									<textarea class="form-control summernotecontent" name="special_employment_condition" rows="2" placeholder="Explain any Special Employment Condition" required> {{ $hireRequisitionJobs->special_employment_condition }}</textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-6 col-lg-6">
									<label class="form-label">Establishment</label>
									<select name="establishment" id="select-establishment" class="form-control custom-select establishment select2" data-placeholder="Select Establishment">
										<option></option>
										@foreach($establishments as $establishment)
										<option {{ isset( $hireRequisitionJobs->establishment ) && $hireRequisitionJobs->establishment == $establishment->id  ? 'selected' : '' }} value="{{$establishment->id}}">{{$establishment->name}}</option>
										@endforeach
									</select>
									@error('establishment_cv_id')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
									@enderror
								</div>
								<div class="col-6 col-lg-6">
									<div class="form-label">Is there a budget for this position ?.</div>
									<div class="d-flex flex-row">
										<div class="d-flex flex-row">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" {{ ($hireRequisitionJobs->has_budget == 1) ? 'checked':'' }} name="has_budget" id="has_budget" value="1">
												<label class="form-check-label" for="inlineRadio1">yes</label>
											</div>
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="radio" {{ ($hireRequisitionJobs->has_budget == 0 || $hireRequisitionJobs->has_budget == NULL) ? 'checked':'' }} name="has_budget" id="has_budget" value="0">
												<label class="form-check-label" for="inlineRadio2">No</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-6 col-lg-6 employee" style="display: {{ $hireRequisitionJobs->establishment == 22 ? 'block' :'none'  }}">
									<label class="form-label">Staff to be replaced</label>
									<select name="employee_id" id="select-employee" data-placeholder="Select Staff to be replaced" class="form-control d-block select2-show-search" multiple>
										<option></option>
										@foreach($users as $user)
										<option {{ isset($hireRequisitionJobs->replacedStaffs[0]->user_id) &&  $hireRequisitionJobs->replacedStaffs[0]->user_id ==  $user->id ? 'selected' :''  }} value="{{$user->id}}">{{$user->fullName}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-6">
									<label class="form-label">Working Tools</label>
									<select name="tools[]" id="select-region" style="width: 100%" class="form-control custom-select select2-show-search" data-placeholder="select working tool" multiple>
										<option>Select Working Tools</option>

										@foreach($tools as $tool)
										<option {{ in_array($tool->id,$current_working_tools) ? 'selected' :'' }} value="{{$tool->id}}"> {{ $tool->name }} </option>
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
									<button type="button" class="btn btn-inline-block btn-azure next-step"> <i class="fa-solid fa-greater-than"></i> Proceed > </button>
								</div>
							</div>
						</div>
			</div>
			<div class="tab-pane " id="returned">
				<div class="card-body">
					<button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Set Criteria</button>
					<table class="table table-bordered" id="criteria_table">
						<thead>
							<tr>
								<th colspan="2">Criteria</th>
								<th>Weight</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$total = 0;
							?>
							@foreach($criteriaWeights as $criteriaWeight)
							
							<tr>
								<td>{{ $criteriaWeight->name }} </td>
								<td>
									@if($criteriaWeight->hr_hire_requisitioin_job_criteria_id == 3)
									<ul>
										@foreach($_skills as $_skill)
										<li> {{ $_skill->name  }} </li>
										@endforeach
									</ul>
									@endif
									@if($criteriaWeight->hr_hire_requisitioin_job_criteria_id == 4)
									<ul>
										@foreach($_experiences as $_experience)
										<li> {{ $_experience->description  }} </li>
										@endforeach
									</ul>
									@endif
									@if($criteriaWeight->hr_hire_requisitioin_job_criteria_id == 1)
									<ul>
										@foreach($education_levels as $education_level)
										@if($hireRequisitionJobs->education_level == $education_level->id )
										<li> {{ $education_level->name  }} </li>
										@endif
										@endforeach
									</ul>
									@endif
									@if($criteriaWeight->hr_hire_requisitioin_job_criteria_id == 2)
									<ul>
										<li> Minimum Age {{ $hireRequisitionJobs->start_age }} </li>
										<li> Maxmum Age {{ $hireRequisitionJobs->end_age }} </li>
									</ul>
									@endif
								</td>
								<td>{{ $criteriaWeight->weight }}</td>
								<td><a class="delete" data-hirerequisitionid='{{ $hireRequisitionJobs->id }}' data-id='{{$criteriaWeight->id}}'>Delete</a></td>
							</tr>
							<?php
							$total += $criteriaWeight->weight;
							?>
							@endforeach
							<tr>
								<td></td>
								<td>Total</td>
								<td>{{ $total }}</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="row mt-3">
					<div class="col-6">
					</div>
					<div class="col-6">
						<button type="button" class="btn btn-inline-block btn-azure prev-step">
							< Back 
						</button>
						<button type="submit" name="update" value="update" class="btn btn-inline-block btn-azure"> Update</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Criteria</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				@csrf
				<div class="row">
					<label>Criteria</label>
					<select name="criteria_id" id="criteria_id" style="width: 100%" class="form-control custom-select select2-show-search" data-placeholder="Education Level">
						<option></option>
						@foreach($criterias as $criteria)
						<option value="{{$criteria->id}}">{{$criteria->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="row" id="education" style="display:none;">
					<label> Education </label>
					<select name="education_level_id" id="select-region" style="width: 100%" class="form-control custom-select select2-show-search" data-placeholder="Education Level">
						<option></option>
						@foreach($education_levels as $education_level)
						<option value="{{$education_level->id}}">{{$education_level->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="row" id="skill" style="display:none;">
					<label> Skills </label>
					<select class="form-control select2-show-search" id="skills" name="skills[]" multiple data-placeholder="Select skill">
						<option></option>
						@foreach($skills as $skill)
						<option value="{{$skill->id}}">{{$skill->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="row" id="experience" style="display:none;">
					<label> Experiences </label>
					<select class="form-control select2-show-search" id="experiences" name="experiences[]" multiple data-placeholder="Select skill">
						<option></option>
						@foreach($experiences as $experience)
						<option value="{{$experience->id}}">{{$experience->description}}</option>
						@endforeach
					</select>
				</div>
				<div class="row mt-2" id="age_limit" style="display:none;">
					<div class="d-flex">
						<input type="number" placeholder="minimum age" name="start_age" class="form-control">
						<input type="number" placeholder="maximum age" name="end_age" class="form-control">
					</div>
				</div>
				<div class="row" id="weight" style="display:none;">
					<label> Weight </label>
					<input type="number" name="weight" class="form-control" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="add_criteria" class="btn btn-primary">Save changes</button>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Edit
			</div>
		</div>
	</div>
</div>
@endsection

@push('after-scripts')
<script>
	$(document).ready(function() {
		$(document).on('change', '.establishment', function() {
			if ($(this).val() == 23) {
				$('.budget').show()
				$('.employee').hide()
			}
			if ($(this).val() == 22) {
				$('.employee').show()
				$('.budget').hide()
			}
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

		$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
			var $target = $(e.target);
			if ($target.parent().hasClass('disabled')) {
				return false;
			}
		});

		$(".next-step").click(function(e) {
			var $active = $('.panel-tabs li>.active');
			$active.parent().next().find('.nav-link').removeClass('disabled');
			nextTab($active);
		});

		$(".prev-step").click(function(e) {
			var $active = $('.panel-tabs li>a.active');
			prevTab($active);
		});

		$('#criteria_id').change(function(e) {
			var criteria_id = $(this).val();
			$("#weight").show();
			if (criteria_id == 1) {
				$("#education").show();
				$("#skill").hide();
				$("#experience").hide();
				$("#age_limit").hide();
			} else if (criteria_id == 2) {
				$("#education").hide();
				$("#skill").hide();
				$("#experience").hide();
				$("#age_limit").show();
			} else if (criteria_id == 3) {
				// show skills
				$("#education").hide();
				$("#skill").show();
				$("#experience").hide();
				$("#age_limit").hide();
			} else if (criteria_id == 4) {
				// hide skills
				$("#education").hide();
				$("#skill").hide();
				$("#experience").show();
				$("#age_limit").hide();
			} else if (criteria_id == 5) {
				$("#education").show();
				$("#skill").hide();
				$("#experience").hide();
				$("#age_limit").hide();
			}
		});

		$('#criteria_table').on('click','.edit', function() {
  			console.log("model clicked");
		});

		$('#criteria_table').on('click','.delete', function() {
			var hr_hire_requisition_job_id = $(this).data('hirerequisitionid');
			var criteria_id = $(this).data('id');
			var _csrf = "{{csrf_token()}}";
			 $.ajax({
				type: 'post',
				url: "{{route('hirerequisition.deleteCriteria')}}",
				data: { hr_hire_requisition_job_id: hr_hire_requisition_job_id,criteria_id: criteria_id,_token:_csrf},
				success: function(data){
					console.log(data);
				}
			 });
  			 return confirm('are you sure you want to delete this item');
		});

		$('#exampleModal').on('click','#add_criteria', function() {
			var hr_hire_requisition_job_id = $(this).data('hirerequisitionid');
			var criteria_id = $(this).data('id');
			var _csrf = "{{csrf_token()}}";
			 $.ajax({
				type: 'post',
				url: "{{route('hirerequisition.deleteCriteria')}}",
				data: { hr_hire_requisition_job_id: hr_hire_requisition_job_id,criteria_id: criteria_id,_token:_csrf},
				success: function(data){
					console.log(data);
				}
			 });
  			 return confirm('are you sure you want to delete this item');
		});

	});

	function nextTab(elem) {
		$(elem).parent().next().find('a[data-toggle="tab"]').click();
	}

	function prevTab(elem) {
		$(elem).parent().prev().find('a[data-toggle="tab"]').click();
	}
</script>
<style>
	.breadcrumb1 {
		background-color: rgb(152, 186, 217);
		border-radius: 0;
	}

	.breadcrumb1 li {
		margin: 0;
	}

	.gray {
		background-color: #f2f5fb;
	}
</style>

@endpush