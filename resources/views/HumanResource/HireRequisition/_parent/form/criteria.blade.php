@extends('layouts.app')
@section('content')
@include('HumanResource.HireRequisition._parent.form.step_header')
<button type="button"  data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">Set Criteria</button>
<table class="table table-bordered" id="criteria_table">
	<thead>
		<tr>
			<th colspan="2">Criteria</th>
			<th>Weight</th>
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
								@if($hireRequisitionJob->education_level == $education_level->id )
									<li> {{ $education_level->name  }} </li>
								@endif
							@endforeach
						</ul>
					@endif
					@if($criteriaWeight->hr_hire_requisitioin_job_criteria_id == 2)
						<ul>
							 
						 
									<li> Minimum Age {{ $hireRequisitionJob->start_age }} </li>
									<li> Maxmum Age {{ $hireRequisitionJob->end_age }} </li>
							 
							 
						</ul>
					@endif

				</td>
				<td>{{ $criteriaWeight->weight }}</td>
			</tr>
		<?php
			$total += $criteriaWeight->weight;
		?>
		@endforeach
		<tr>
			<td></td><td>Total</td><td>{{ $total }}</td>
		</tr>
		<!-- <tr>
			<td><label class="form-label"> Education Level </label></td>
			<td>
				<select name="education_level" id="select-region" style="width: 100%" class="form-control custom-select select2-show-search" data-placeholder="Education Level" required>
					<option></option>
					@foreach($education_levels as $education_level)
					<option value="{{$education_level->id}}">{{$education_level->name}}</option>
					@endforeach
				</select>
			</td>
			<td>
				<input class="form-control" type="number" name="weight">
			</td>
		</tr>
		<tr>
			<td><label class="form-label"> Minimum Years Of Experince </label></td>
			<td>
				<input type="number" class="form-control" name="experience_years" value="{{old('experience_years')}}" placeholder="Years of experience" required>
			</td>
			<td>
				<input class="form-control" type="number" name="weight">
			</td>
		</tr>
		<tr>
			<td><label class="form-label"> Skills </label></td>
			<td>
				<select class="form-control select2-show-search" id="skills" name="skills[]" multiple data-placeholder="Select skill">
					<option> choose Category</option>
				</select>
			</td>
			<td>
				<input class="form-control" type="number" name="weight">
			</td>
		</tr> -->
	</tbody>
</table>


<!-- <div class="row mt-2">
		<div class="col-8">
			<label class="form-label"> Skill Category </label>
			<select class="form-control select2-show-search" id="skill_category_id" name="skill_category_id" data-placeholder="Select filter">
				<option> choose Category</option>
				@foreach($skillCategories as $skillCategory)
				<option value="{{ $skillCategory->id }}">{{$skillCategory->name}}</option>
				@endforeach
			</select>
		</div>
		@error('practical_experience')
		<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
		@enderror
	</div> -->

<div class="row mt-3">
	<div class="col-6">
	</div>
	<div class="col-6">
		@if(!isset($create))
		<button id="" type="button" name="submit_job_requisition" value="Cancel" class="btn btn-inline-block btn-danger cancel"> <i class="fa fa-times"></i> Cancel </button>
		@endif
		<a href="route()" class="btn btn-inline-block btn-azure prev-step"> <i class="fa fa-angle-left"></i> Back </button>
		<a href="{{ route('hirerequisition.hire_requisition_job_show',$uuid) }}" class="btn btn-inline-block btn-azure"> <i class="fa fa-save"></i> Next</a>
	</div>
</div>
<!-- Modal -->
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
				<form action="{{route('hirerequisition.steps.add_criteria',$uuid)}}" method="get">
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
						 <input type="number" placeholder="minimum age" name="start_age"class="form-control">
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
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
			</form>
		</div>
	</div>
</div>
@include('HumanResource.HireRequisition._parent.form.step_footer')
@endsection('content')
@push('after-scripts')
<script>
	 $('#criteria_id').change(function(e){
		 var criteria_id = $(this).val();
		 $("#weight").show();
		 if(criteria_id == 1){
			$("#education").show();
			$("#skill").hide();
			$("#experience").hide();
			$("#age_limit").hide();
		 }else if(criteria_id == 2){
			
			$("#education").hide();
			$("#skill").hide();
			$("#experience").hide();
			$("#age_limit").show();
		 }else if(criteria_id == 3){
			// show skills
			$("#education").hide();
			$("#skill").show();
			$("#experience").hide();
			$("#age_limit").hide();
		 }else if(criteria_id == 4){
			// hide skills
			$("#education").hide();
			$("#skill").hide();
			$("#experience").show();
			$("#age_limit").hide();
		 }else if(criteria_id == 5){
			$("#education").show();
			$("#skill").hide();
			$("#experience").hide();
			$("#age_limit").hide();
		 }
	 });
</script>
@endpush
