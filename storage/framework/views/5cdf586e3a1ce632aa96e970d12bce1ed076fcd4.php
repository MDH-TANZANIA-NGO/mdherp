<?php $__env->startSection('content'); ?>
    <div class="row mb-2">
        <div class="col-lg-12">
            <?php echo $__env->make('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Job Offer Details</h3>
                    <div class="card-options">
                        <a href="<?php echo e(route('job_offer.print', $job_offer->uuid)); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-print"></i> Print</a>
                        <?php if($job_offer->wf_done == 0 and $job_offer->user_id == access()->user()->id): ?>
                            <a href="<?php echo e(route('job_offer.edit', $job_offer->uuid)); ?>" class="btn btn-instagram btn-sm" style="margin-left: 2%">Edit</a>
                            <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <h4 class="mb-1"><strong><?php echo e($job_offer->interviewApplicant->applicant->full_name); ?></strong>,</h4>
                        has been given offer of <strong>$<?php echo e(currency_converter($job_offer->salary, 'TSH')); ?></strong> (USD) for job position as <b><?php echo e(strtoupper($job_offer->interviewApplicant->interviews->jobRequisition->designation->full_title)); ?></b>
                    </div>

                    <div class="card-body pl-0 pr-0">
                        <div class="row">
                            <div class="col-sm-6">
                                <span>Job offer No.</span><br>
                                <strong><?php echo e($job_offer->number); ?></strong>
                            </div>
                            <div class="col-sm-6 text-right">
                                <span>Expected arrival date</span><br>
                                <strong><?php echo e(today()); ?></strong>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row">
                        <div class="card">








                            <div class="card-body">
                                <?php echo htmlspecialchars_decode($job_offer->details); ?>

                             </div>
                        </div>
                    </div>























                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/humanResource/jobOffer/display/show.blade.php ENDPATH**/ ?>