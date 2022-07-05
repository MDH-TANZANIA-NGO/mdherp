<?php $__env->startSection('content'); ?>
<?php if(isset($initiate)): ?>
<?php echo $__env->make('HumanResource.HireRequisition._parent.datatables.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<div class="panel panel-primary add_requisition_body" style="display: <?php echo e(isset($create) && $create == true ? '':'none'); ?> ">
	<div class=" tab-menu-heading card-header sw-theme-dots">
		<div class="tabs-menu1">
			<!-- Tabs -->
			<ul class="nav panel-tabs">
				<li class="nav-item"><a href="#processing" class="nav-link active" data-toggle="tab">1.General</a></li>
				<li class="nav-item"><a href="#returned" class="nav-link disabled" data-toggle="tab">2.Criteria</a></li>
			</ul>
		</div>
		<div class="page-rightheader ml-auto d-lg-flex d-non pull-right">
			<div class="btn-group mb-0">
			</div>
		</div>
	</div>
	<div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
		<div class="tab-content">
			<div class="tab-pane active" id="processing">
				<?php if(isset($initiate)): ?>
				<form action="<?php echo e(route('hirerequisition.addRequisition',$uuid)); ?>" method="post">
					<?php else: ?>
					<form action="<?php echo e(route('hirerequisition.store')); ?>" method="post">
						<?php endif; ?>
						<?php echo csrf_field(); ?>
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
										<?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($department->id); ?>"><?php echo e($department->title); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['department_id'];
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

								<div class="col-6 col-lg-6">
									<label class="form-label">Job Title</label>
									<?php echo Form::select('job_title',$designations,null,['class' => 'form-control select2-show-search', 'id' => 'select-department', 'placeholder' => 'select job title']); ?>

								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<label class="form-label">Number of Employees Required</label>
									<input type="number" class="form-control" name="empoyees_required" placeholder="ie. 1, 4" required>
									<?php $__errorArgs = ['number'];
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
								<div class="col-6">
									<label class="form-label">Location</label>
									<select name="region[]" id="select-region" class="form-control select2-show-search" data-placeholder="select location" multiple>
										<option value="">Select Location</option>
										<?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($region->id); ?>"><?php echo e($region->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['region_id'];
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
							<div class="row">
								<div class="col-12 col-lg-12">
									<label class="form-label">Duties And Resposibilities</label>
									<textarea type="text" class="form-control summernotecontent" name="duties_and_responsibilities" placeholder="Duties and responsibilities here" required></textarea>
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
							<div class="row">
								<div class="col-6">
									<label class="form-label">Date Required</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<div class="input-group-text">
												<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
											</div>
										</div><input class="form-control" name="date_required" placeholder="MM/DD/YYYY" type="date">
									</div>
									<?php $__errorArgs = ['date_required'];
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

								<div class="col-6">
									<label class="form-label">Prospect for appointment</label>
									<?php $__currentLoopData = $prospects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prospect): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<label class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" name="prospect_for_appointment_cv_id" value="<?php echo e($prospect->id); ?>" checked>
										<span class="custom-control-label"><?php echo e($prospect->name); ?></span>
									</label>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php $__errorArgs = ['prospect_for_appointment_cv_id'];
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
							<ol class="breadcrumb1">
								<li class="breadcrumb-item1 h5"> Person Requirement </li>
							</ol>
							<div class="row mt-2">
								<div class="col-12 ">
									<label class="form-label">Education And Qualification</label>
									<textarea class="form-control summernotecontent " id="education_and_qualification" name="education_and_qualification" rows="2" placeholder="Describe the requirements for education and qualifications for this post" required></textarea>
								</div>
								<?php $__errorArgs = ['education_and_qualification'];
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
							<div class="row mt-2">
								<div class="col-12">
									<label class="form-label">Practical Experience</label>
									<textarea class="form-control summernotecontent" name="practical_experience" rows="4" placeholder="Practical experience required for this post" required></textarea>
								</div>
								<?php $__errorArgs = ['practical_experience'];
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
							<div class="row mt-2">
								<div class="col-12">
									<label class="form-label">Other Special Qualities/Skills</label>
									<textarea class="form-control  summernotecontent" name="special_qualities_skills" rows="4" placeholder="Other Special Qualities or Skills" required></textarea>
								</div>
								<?php $__errorArgs = ['other_qualities'];
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
									<?php $__currentLoopData = $contract_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contract_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<label class="custom-control custom-radio">
										<input type="radio" class="custom-control-input" name="contract_type" value="<?php echo e($contract_type->id); ?>" checked>
										<span class="custom-control-label"><?php echo e($contract_type->name); ?></span>
									</label>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php $__errorArgs = ['employment_condition_cv_id'];
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

								<?php $__errorArgs = ['special_employment_condition'];
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
							<div class="row">
								<div class="col-lg-12">
									<label class="form-label">Explain any Special Employment Condition</label>
									<textarea class="form-control summernotecontent" name="special_employment_condition" rows="2" placeholder="Explain any Special Employment Condition" required></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-6 col-lg-6">
									<label class="form-label">Establishment</label>
									<select name="establishment" id="select-establishment" class="form-control custom-select establishment select2" data-placeholder="Select Establishment">
										<option></option>
										<?php $__currentLoopData = $establishments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $establishment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($establishment->id); ?>"><?php echo e($establishment->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['establishment_cv_id'];
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
								<div class="col-6 col-lg-6 budget " style="display: none">
									<div class="form-label">Is there a budget for this position?</div>
									<div class="d-flex flex-row">
										<input type="number" name="budget" class="form-control" placeholder="enter budget here">
									</div>
								</div>
								<div class="col-6 col-lg-6 employee" style="display: none">
									<label class="form-label">Staff to be replaced</label>
									<select name="employee_id" id="select-employee" data-placeholder="Select Staff to be replaced" class="form-control d-block select2-show-search" multiple>
										<option></option>
										<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($user->id); ?>"><?php echo e($user->fullName); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</div>
							</div>
							<div class="row mt-2">
								<div class="col-6">
									<label class="form-label">Working Tools</label>
									<select name="tools[]" id="select-region" style="width: 100%" class="form-control custom-select select2-show-search" data-placeholder="select working tool" multiple>
										<option>Select Working Tools</option>
										<?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($tool->id); ?>"><?php echo e($tool->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<?php $__errorArgs = ['tool_id'];
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
									<?php if(!isset($create)): ?>
									<button type="button" name="submit_job_requisition" value="Cancel" class="btn btn-inline-block btn-danger cancel"> <i class="fa fa-times"></i> Cancel </button>
									<?php endif; ?>
									<button type="button" class="btn  btn-primary next-step"> <i class="fa fa-angle-right"></i> Proceed </button>
								</div>
							</div>

						</div>
			</div>
			<div class="tab-pane " id="returned">
				<div class="card-body">
					<div class="row mt-2">
						<div class="col-8">
							<label class="form-label"> Education Level </label>
							<select name="education_level" id="select-region" style="width: 100%" class="form-control custom-select select2-show-search" data-placeholder="Education Level">
								<option></option>
								<?php $__currentLoopData = $education_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education_level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($education_level->id); ?>"><?php echo e($education_level->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<?php $__errorArgs = ['practical_experience'];
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
					<div class="row mt-2">
						<div class="col-8">
							<label class="form-label"> Minimum Years Of Experince </label>
							<div class="d-flex flex-row">
								<input type="number" class="form-control" name="experience_years" placeholder="Years of experience" required>
							</div>
						</div>
						<div class="col-2">
						</div>
						<?php $__errorArgs = ['practical_experience'];
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

					<div class="form-group row mt-2">
						<div class="col-2">
							<label class="form-label"> Age </label>
						</div>
						<div class="col-8 d-flex flex-row">
							<span class="mr-2"> Between </span>
							<input type="number" class="form-control" name="start_age">
							<span class="mx-2"> And </span>
							<input type="number" class="form-control" name="end_age">
						</div>
						<?php $__errorArgs = ['practical_experience'];
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
					<div class="row mt-2">
						<div class="col-8">
							<label class="form-label"> Skill Category </label>
							<select class="form-control select2-show-search" id="skill_category_id" name="skill_category_id" data-placeholder="Select filter">
								<option> choose Category</option>
								<?php $__currentLoopData = $skillCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skillCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($skillCategory->id); ?>"><?php echo e($skillCategory->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						</div>
						<?php $__errorArgs = ['practical_experience'];
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
					<div class="row mt-2">
						<div class="col-8">
							<label class="form-label"> Skills </label>
							<select class="form-control select2-show-search" id="skills" name="skills[]" multiple data-placeholder="Select skill">
								<option> choose Category</option>
							</select>
						</div>
						<?php $__errorArgs = ['practical_experience'];
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
					<div class="row mt-3">
						<div class="col-6">
						</div>
						<div class="col-6">
							<?php if(!isset($create)): ?>
							<button id="" type="button" name="submit_job_requisition" value="Cancel" class="btn btn-inline-block btn-danger cancel"> <i class="fa fa-times"></i> Cancel </button>
							<?php endif; ?>
							<button type="button" class="btn btn-inline-block btn-azure prev-step"> <i class="fa fa-angle-left"></i> Back </button>
							<button type="submit" name="submit_job_requisition" value="add" class="btn btn-inline-block btn-azure"> <i class="fa fa-save"></i> Add Requisition</button>

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
			url = "<?php echo e(route('hirerequisition.category_skills',':property_id')); ?>";
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

	<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/humanResource/hireRequisition/_parent/form/create.blade.php ENDPATH**/ ?>