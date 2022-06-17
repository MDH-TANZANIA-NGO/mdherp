@extends('layouts.app')
@section('content')
@if(isset($initiate))
@include('HumanResource.HireRequisition._parent.datatables.index')
@endif
<div class="panel panel-primary">
    <div class=" tab-menu-heading card-header sw-theme-dots">
		Approved Job Requisition
    </div>
    <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
         
			 
				@if(isset($initiate))
					<form action="{{route('hirerequisition.addRequisition',$uuid)}}" method="post">
				@else
					<form action="{{route('hirerequisition.store')}}" method="post">
				@endif
				@csrf
				<!-- Large Modal -->
					<div class="col-lg-12 col-md-12">
							<table id="access_processing" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="wd-15p">#</th>
                                        <th class="wd-15p">TITLE</th>
                                        <th class="wd-15p">REGION</th>
                                        <th class="wd-25p"># OF EMPLOYEES</th>
                                        <th class="wd-25p">CREATED AT</th>
										<th class="wd-25p">CREATED BY</th>
										<th class="wd-25p">APPROVED ON</th>
                                        <th class="wd-25p">ACTION</th>
                                    </tr>
                                </thead>
								<tbody>
								@foreach($hireRequisitionJobs as $key=>$hireRequisitionJob)
									<tr class="wd-15p"> 
										<td>{{$key+1}}</td>
                                        <td>{{$hireRequisitionJob->title}}</td>
                                        <td>{{ $hireRequisitionJob->region }}</td>
                                        <td>{{ $hireRequisitionJob->empoyees_required }}</td>
                                        <td>{{ $hireRequisitionJob->created_at }}</td>
                                        <td>{{ $hireRequisitionJob->created_at }}</td>
                                        <td>{{ $hireRequisitionJob->created_at }}</td>
                                        <td><a href="{{ route('advertisement.initiate',$hireRequisitionJob->uuid) }}"> Create Advertisement </a></td>
									<tr>
								@endforeach
								</tbody>
						</table>
					
				</div>
				</div>
			 
				 
				
				</form>
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
			
			$(".other_qualities").richText();
			$(".education").richText();
			$('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
				var $target = $(e.target);
				if ($target.parent().hasClass('disabled')) {
					return false;
				}
			});

			$(".next-step").click(function (e) {
				var $active = $('.panel-tabs li>.active');
				$active.parent().next().find('.nav-link').removeClass('disabled');
				nextTab($active);
			});
			
			$(".prev-step").click(function (e) {
				var $active = $('.panel-tabs li>a.active');
				prevTab($active);
			});
        });

		function nextTab(elem) {
			$(elem).parent().next().find('a[data-toggle="tab"]').click();
		}
		function prevTab(elem) {d
			$(elem).parent().prev().find('a[data-toggle="tab"]').click();
		}

		$(document).on('change','#skill_category_id',function(){
				skill_category_id = $(this).val(); 
				url = "{{ route('hirerequisition.category_skills',':property_id') }}";
				 url = url.replace(':property_id', skill_category_id);
				$.ajax({
					url: url,
					type:'get',
					dataType: "json",
					data:{ skill_category_id: skill_category_id}, 
					success:function(data){
						var option ="";
						$.each(data,function(key,value){
							option += "<option value='"+value.id+"'>"+value.name+"</option>";
						})
						$('#skills').html(option);
					},
					error:function(data){
					}
				});
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
	 
    .gray{
        background-color: #f2f5fb;
    }
      
 

    </style>

@endpush




