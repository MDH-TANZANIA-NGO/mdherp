@extends('layouts.app')
@section('content')
@if(isset($initiate))
@include('HumanResource.HireRequisition._parent.datatables.index')
@endif
<div class="card">
	<div class="card-body" style="background-color:#FFFFFF">
		<form action="{{route('advertisement.postAdvertisement',$_advertisement->uuid)}}" method="post">
			@csrf
			<input type="hidden" name="hr_requisition_job_id" value="{{$_advertisement->hire_requisition_job_id}}">
			<input type="hidden" name="advertisement_id" value="{{$_advertisement->id}}">
			 
			
			<div class="row mb-3">
				<div class="col-2 col-lg-2">
					<label class="form-label"> Dead Line </label>
				</div>
				<div class="col-8 col-lg-8">
					<input type="date" class="form-control" required name="dead_line">
				</div>
			</div>
			 
			<div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title"> {{ $_advertisement->title }} </h3>
                        <div class="card-title">
                           
                        Number: <span> {{ $_advertisement->number }} </span> 
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $_advertisement->description !!}
                    </div>
                </div>
            </div>
        </div>
   
			<div class="form-group row mt-3">
				<div class="col-6">
				</div>
				<div class="col-6">
					<button type="submit" class="btn btn-inline-block btn-azure next-step"> <i class="fa fa-paper-plane"></i> Publish</button>
				</div>
			</div>
		</form>
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

		$("#education").richText({
			preview: true,
			adaptiveHeight: true,
		});

		$('.summernotecontent').summernote({
			height: '100%',
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

		$(".other_qualities").richText();
		$(".education").richText();
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
		d
		$(elem).parent().prev().find('a[data-toggle="tab"]').click();
	}

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
				})
				$('#skills').html(option);
			},
			error: function(data) {}
		});
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