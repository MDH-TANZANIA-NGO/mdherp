<?php $__env->startSection('content'); ?>
<?php if(isset($initiate)): ?>
<?php echo $__env->make('HumanResource.HireRequisition._parent.datatables.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<div class="panel panel-primary">
    <div class=" tab-menu-heading card-header sw-theme-dots">
         
		General
    </div>
    <div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
         
			 
				<?php if(isset($initiate)): ?>
					<form action="<?php echo e(route('hirerequisition.addRequisition',$uuid)); ?>" method="post">
				<?php else: ?>
					<form action="<?php echo e(route('advertisement.store')); ?>" method="post">
				<?php endif; ?>
				<?php echo csrf_field(); ?>
				<!-- Large Modal -->
					<div class="col-lg-12 col-md-12">
					<div class="row">
							<div class="col-2 col-lg-2">
								<label class="form-label">Requisition Number</label>
								<?php echo e($hireRequisition->number); ?>

							</div>
							<div class="col-2 col-lg-2">
								<label class="form-label">Job Title</label>
							</div>
							<input type="hidden" name = 'hr_requisition_job_id' value="<?php echo e($hireRequisitionJob->id); ?>">
							<div class="col-2 col-lg-2">
								 <?php echo e($hireRequisitionJob->title); ?>    
							</div>
							<div class="col-2 col-lg-2">
							<label class="form-label">Employee(s) Required</label>
							</div>
							<div class="col-2 col-lg-2">
								 <?php echo e($hireRequisitionJob->empoyees_required); ?>    
							</div>
						</div>
						<div class="row">
							<div class="col-2 col-lg-2">
							<label class="form-label">Post Title </label>
							</div>
							<div class="col-8 col-lg-8">
								<input type="text" class="form-control" value="" name="title">	         
							</div>
						</div>
						 
						<div class="row">
							<div class="col-2 col-lg-2">
							<label class="form-label"> Dead Line </label>
							</div>
							<div class="col-8 col-lg-8">
								<input type="date" class="form-control" name="dead_line">	         
							</div>
						</div>
						 
						<div class="row">
							<div class="col-12 col-lg-12" >
								<label class="form-label">Description</label>
								<textarea type="text" rows="10" class="form-control summernotecontent" name="description" placeholder="description" required></textarea>
								<?php $__errorArgs = ['duties_and_responsibilities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
									<span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong> </span>
								<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
							</div>						 
						</div>
						<div class="row mt-3">
							<div class="col-6">
							</div>
							<div class="col-6">
								<button type="submit"  class="btn btn-inline-block btn-azure next-step"> <i class="fa fa-paper-plane"></i> Submit For Approval </button>	
							</div>
						</div>
					
				</div>
				</div>
			 
				 
				
				</form>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('after-scripts'); ?>
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
				url = "<?php echo e(route('hirerequisition.category_skills',':property_id')); ?>";
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

<?php $__env->stopPush(); ?>





<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/humanResource/hireRequisition/advertisement/form/initiate.blade.php ENDPATH**/ ?>