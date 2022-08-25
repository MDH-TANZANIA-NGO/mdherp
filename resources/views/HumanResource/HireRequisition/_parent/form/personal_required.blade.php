@extends('layouts.app')
@section('content')
@include('HumanResource.HireRequisition._parent.form.step_header')
<form action="{{route('hirerequisition.steps.personal_requirement',$uuid)}}" method="POST">
@csrf
<div class="row mt-2">
	<div class="col-12">
		<label class="form-label">Education And Qualification</label>
		<textarea class="form-control summernotecontent" id="education_and_qualification" name="education_and_qualification" rows="2" placeholder="Describe the requirements for education and qualifications for this post" required>{{ $hireRequisitionJob->education_and_qualification }}</textarea>
		
	</div>
	@error('education_and_qualification')
	<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
	@enderror
</div>
<div class="row mt-2">
	<div class="col-12">
		<label class="form-label">Practical Experience</label>
		<textarea class="form-control summernotecontent" name="practical_experience" rows="4" placeholder="Practical experience required for this post" required>{{ $hireRequisitionJob->practical_experience }}</textarea>
	</div>
	@error('practical_experience')
	<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
	@enderror
</div>
<div class="row mt-2">
	<div class="col-12">
		<label class="form-label">Other Special Qualities/Skills</label>
		<textarea class="form-control  summernotecontent" name="special_qualities_skills" rows="4" placeholder="Other Special Qualities or Skills" required>{{ $hireRequisitionJob->special_qualities_skills }}</textarea>
	</div>
	@error('other_qualities')
	<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
	@enderror
</div>
<div class="row mt-3">
	<div class="col-6">
	</div>
	<div class="col-6">
		<a href="{{ route('hirerequisition.initiate',$uuid) }}" class="btn btn-inline-block btn-azure prev-step"> <i class="fa fa-angle-left"></i> Back </a>
		<button type="submit" class="btn  btn-primary next-step"> <i class="fa fa-angle-right"></i> Next </button>
	</div>
</div>
</form>
@include('HumanResource.HireRequisition._parent.form.step_footer')
@endsection('content')