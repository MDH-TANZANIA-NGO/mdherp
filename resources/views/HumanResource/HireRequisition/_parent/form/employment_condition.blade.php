@extends('layouts.app')
@section('content')
@include('HumanResource.HireRequisition._parent.form.step_header')
<form action="{{route('hirerequisition.steps.employement_condition',$uuid)}}" method="POST">
@csrf
<div class="row mt-2">
	<div class="col-6">
		<label class="form-label">Employment Condition</label>
		@foreach($contract_types as $contract_type)
		<div class="form-check form-check-inline">
			<input class="form-check-input" {{ ($hireRequisitionJob->hr_contract_type_id == $contract_type->id) ? 'checked':'' }} type="radio" name="contract_type" id="employment_condition" value="{{ old('contract_type',$contract_type->id)}}">
			<label class="form-check-label" for="inlineRadio1">{{$contract_type->name}}</label>
		</div>
		@endforeach
		@error('employment_condition_cv_id')
		<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
		@enderror
	</div>
	@error('special_employment_condition')
	<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
	@enderror
</div>
<div class="row mt-2">
	<div class="col-lg-12">
		<label class="form-label">Explain any Special Employment Condition</label>
		<textarea class="form-control summernotecontent" name="special_employment_condition" rows="2" placeholder="Explain any Special Employment Condition" required>
			{{ old('special_employment_condition')}}
			{{ $hireRequisitionJob->special_employment_condition }}
		</textarea>
	</div>
</div>
<div class="row mt-2">
	<div class="col-6 col-lg-6">
		<label class="form-label">Establishment</label>
		<select name="establishment" id="select-establishment" class="form-control custom-select establishment select2" data-placeholder="Select Establishment">
			<option></option>
			@foreach($establishments as $establishment)
				<option {{ ($hireRequisitionJob->establishment == $establishment->id) ? 'selected':'' }} value="{{$establishment->id}}">{{$establishment->name}}</option>
			@endforeach
		</select>
		@error('establishment_cv_id')
		<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
		@enderror
	</div>
	<div class="col-6 col-lg-6 budget " style="display: none">
		<div class="form-label">Is there a budget for this position?</div>
		<div class="d-flex flex-row">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="has_budget" id="has_budget" value="1">
				<label class="form-check-label" for="inlineRadio1">yes</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="has_budget" id="has_budget" value="0">
				<label class="form-check-label" for="inlineRadio2">No</label>
			</div>
		</div>
	</div>
	<div class="col-6 col-lg-6 employee" style="display: none">
		<label class="form-label">Staff to be replaced</label>
		<select name="employee_id" id="select-employee" data-placeholder="Select Staff to be replaced" class="form-control d-block select2-show-search" multiple>
			<option></option>
			@foreach($users as $user)
			<option value="{{$user->id}}">{{$user->fullName}}</option>
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
			<option {{ in_array($tool->id,$current_working_tools) ? 'selected':''  }} value="{{$tool->id}}">{{$tool->name}}</option>
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
		@if(!isset($create))
		<button type="button" name="submit_job_requisition" value="Cancel" class="btn btn-inline-block btn-danger cancel"> <i class="fa fa-times"></i> Cancel </button>
		@endif
		<button type="button" class="btn btn-inline-block btn-azure prev-step"> <i class="fa fa-angle-left"></i> Back </button>
		<button type="submit" class="btn  btn-primary next-step"> <i class="fa fa-angle-right"></i> Proceed </button>
	</div>
</div>
</form>
@include('HumanResource.HireRequisition._parent.form.step_footer')
@endsection('content')
