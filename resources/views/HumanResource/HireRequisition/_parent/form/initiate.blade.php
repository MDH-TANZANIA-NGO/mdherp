@extends('layouts.app')
@section('content')
@if(isset($initiate))
@endif
@include('HumanResource.HireRequisition._parent.form.step_header')
		<div class="tab-content">
			<div class="tab-pane active" id="processing">
			@if(isset($initiate))
			<form action="{{route('hirerequisition.steps.general',$uuid)}}" method="POST">
			@else
			<form action="{{route('hirerequisition.store')}}" method="POST">
				@endif
				@csrf
				@include('HumanResource.HireRequisition._parent.form.general')
			</from>
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
		// $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		// 	var $target = $(e.target);
		// 	if ($target.parent().hasClass('disabled')) {
		// 		return false;
		// 	}
		// });

		// $(".next-step").click(function(e) {
		// 	var $active = $('.panel-tabs li>.active');
			
		// 	$active.parent().next().find('.nav-link').removeClass('disabled');
		// 	nextTab($active);
		// });
		// $(".prev-step").click(function(e) {
		// 	var $active = $('.panel-tabs li>a.active');
		// 	prevTab($active);
		// });
	});

	// function nextTab(elem) {
	// 	$(elem).parent().next().find('a[data-toggle="tab"]').click();
	// }

	// function prevTab(elem) {
	// 	$(elem).parent().prev().find('a[data-toggle="tab"]').click();
	// }
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