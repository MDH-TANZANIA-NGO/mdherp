<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Job Offer</h3>
            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
            </div>
        </div>
        <div class="card-body">

                <?php echo Form::open(['route' => 'job_offer.create','method'=>'GET']); ?>



                <div class="form-group">
                    <label class="form-label">Select selected candidate</label>
                    <div class="row gutters-xs">
                        <div class="col">
                            <?php echo Form::select('id', $applicant, null, ['class' =>'form-control select2-show-search','required', 'placeholder' => __('label.select') , 'aria-describedby' => '']); ?>


                        </div>
                        <span class="col-auto">
																<button class="btn btn-primary" type="submit">Next <i class="fa fa-arrow-circle-o-right"></i></button>
	</span>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>


        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/humanResource/jobOffer/forms/initiate.blade.php ENDPATH**/ ?>