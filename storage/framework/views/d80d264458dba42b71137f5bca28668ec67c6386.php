<div class="row">
    <div class="card">
        <div class="card-header">
			<h3 class="card-title">INTERVIEW REQUEST </h3>
		</div>
        <div class="card-body">
            <?php echo Form::open(['route' => 'interview.store']); ?>

            <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">Job </label>
						<?php echo Form::select('hr_requisition_job_id',$designations,null,['class' => 'form-control select2', 'placeholder'=>'Select','required']); ?>

                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">Interview Type</label>
                        <?php echo Form::select('interview_type_id',$interview_types,null,['class' => 'form-control', 'placeholder'=>'Select','required']); ?>

						 
                    </div>
                </div>
               
                <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4">
                    <div class="form-group">
						<label class="form-label">&nbsp;</label>
                        <button type="submit" class="btn btn-primary">Initiate</button>
                    </div>
                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/form/new.blade.php ENDPATH**/ ?>