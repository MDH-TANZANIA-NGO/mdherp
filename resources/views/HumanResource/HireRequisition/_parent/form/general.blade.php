<div class="row">
	<div class="col-6 col-lg-6">
		<label class="form-label">Report To</label>
		{!! Form::select('report_to',$designations,null,['class' => 'form-control select2-show-search', 'id' => 'report_to', 'placeholder' => 'select title','required'=>'true']) !!}
	</div>
	<div class="col-6">
		<label class="form-label">Number of Employees Required</label>
		<input type="number" id="empoyees_required" class="form-control" value="{{ old('empoyees_required') }}" name="empoyees_required" placeholder="ie. 1, 4" required>
		@error('number')
		<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
		@enderror
	</div>
</div>
<div class="row">
	
	<div class="col-6">
		<label class="form-label">Location</label>
		<select name="region[]" id="select-region" class="form-control select2-show-search" data-placeholder="select location" multiple required>
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
	<div class="col-12 col-lg-12">
		<label class="form-label">Possition Summary</label>
		<textarea type="text" class="form-control summernotecontent" name="possition_summary" placeholder="Duties and responsibilities here" required>{{ old('possition_summary') }}</textarea>
		@error('possition_summary')
		<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
		@enderror
	</div>
</div>
<div class="row">
	<div class="col-12 col-lg-12">
		<label class="form-label">Duties And Resposibilities</label>
		<textarea type="text" class="form-control summernotecontent" name="duties_and_responsibilities" placeholder="Duties and responsibilities here" required>{{ old('duties_and_responsibilities') }}</textarea>
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
			</div><input class="form-control" value="{{ old('date_required') }}" name="date_required" placeholder="MM/DD/YYYY" type="date" required>
		</div>
		@error('date_required')
		<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
		@enderror
	</div>
	<div class="col-6">
		<label class="form-label">Prospect for appointment</label>
		@foreach($prospects as $prospect)
		<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" value="{{ old('prospect_for_appointment_cv_id',$prospect->id) }}" name="prospect_for_appointment_cv_id" id="prospect_for_appointment">
			<label class="form-check-label" for="inlineRadio1">{{$prospect->name}}</label>
		</div>
		@endforeach
		@error('prospect_for_appointment_cv_id')
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
		<button type="submit" class="btn  btn-primary next-step"> <i class="fa fa-angle-right"></i> Next </button>
	</div>
	</form>
</div>
