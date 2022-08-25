@extends('layouts.app')
@section('content')
@if(isset($initiate) && $initiate== true)
<?php
$total_jobs = count($hireRequisitionJobs);
?>
@include('HumanResource.HireRequisition._parent.datatables.index')
@endif
<div class="card">
	<div class="card tabs-menu-body" style="background-color:#FFFFFF">
		<form action="{{route('hirerequisition.store')}}" method="POST">
			@csrf
			<div class="row">
				<input type="hidden" name="hr_hire_requisition_id" value="{{ isset($hireRequisition->id) ? $hireRequisition->id:''}}">
				<div class="col-6 col-lg-6">
					<label class="form-label">Department</label>
					<select name="department_id" id="select-department" data-placeholder="Select Department" class="form-control select2-show-search" required>
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
					{!! Form::select('job_title',$designations,null,['class' => 'form-control select2-show-search', 'id' => 'job_title', 'placeholder' => 'select job title','required'=>'true']) !!}
				</div>
			</div>
			<div class="row">
				<div class="col-6 col-lg-6">
					<input type="submit" class="btn btn-primary">
				</div>
			</div>
			<form>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
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
			if ($(this).val() == 49) {
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
	});

	function nextTab(elem) {
		$(elem).parent().next().find('a[data-toggle="tab"]').click();
	}

	function prevTab(elem) {
		$(elem).parent().prev().find('a[data-toggle="tab"]').click();
	}
	$("#add_requisition").click(function() {
		$(".add_requisition_body").show();
		$(".hire_requisition_list").hide();
	});

	$(".cancel").click(function() {
		$(".add_requisition_body").hide();
		$(".hire_requisition_list").show();
	});

	$(document).on('change', '#skill_category_id', function() {
		skill_category_id = $(this).val();
		url = "{{ route('hirerequisition.category_skills',':property_id') }}";
		url = url.replace(':property_id', skill_category_id);
		$.ajax({
			url: url,
			type: 'get',
			dataType: "json",
			data: {
				skill_category_id: skill_category_id
			},
			success: function(data) {
				var option = "";
				$.each(data, function(key, value) {
					option += "<option value='" + value.id + "'>" + value.name + "</option>";
				});
				$('#skills').html(option);
			}
		});
	});

	var $_department_id = $("[name='department_id']"); // Button that triggered the modal
	$_department_id.change(function(e) {
		$_deparmtment_id = $(this).val();
		url = "{{route('hirerequisition.getDesignationByDepertment',':department_id')}}";
		url = url.replace(':department_id', $_deparmtment_id);
		var $_data = {
			department_id: $(this).val(),
		};
		$.ajax({
			url: url,
			type: "get",
			dataType: 'json',
			success: function(data) {
				var option = "<option></option>";
				$.each(data, function(key, value) {
					option += "<option value='" + value.id + "'>" + value.name + "</option>";
				});
				$("#job_title").html(option);
			}
		});
	});
	
	$(document).on('change', '#job_title', function() {
		designation_id = $(this).val();
		url = "{{ route('hirerequisition.criteriaFilter',':designation_id') }}";
		url = url.replace(':designation_id', designation_id);
		$.ajax({
			url: url,
			type: 'get',
			dataType: "json",
			data: {
				destignation_id: designation_id
			},
			success: function(data) {
				var skills = "<p>";
				data.response.designation_skills.forEach(function(value) {
					skills += "<li>" + value.name + "</li>";
				});
				skills += "<p>";
				var experiences = "<p>";
				data.response.designation_experiences.forEach(function(value) {
					experiences += "<li>" + value.description + "</li>";
				});
				experiences += "<p>";
				var content = $('.summernotecontent').eq(2).summernote('pasteHTML', skills);
				var content = $('.summernotecontent').eq(3).summernote('pasteHTML', experiences);
				var option = "";
				$.each(data.response.designation_skills, function(key, value) {
					option += "<option selected value='" + value.id + "'>" + value.name + "</option>";
				});
				$('#skills').html(option);
			}
		});
		var criteria_table = $('#criteria_table tbody');
		// criteria_table.
	});
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