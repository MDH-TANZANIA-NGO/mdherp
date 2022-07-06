<?php $__env->startSection('content'); ?>
    <div class="row mb-2">
        <div class="col-lg-12">
            <?php echo $__env->make('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <?php if($job_offer->status == 2): ?>
    <ul class="demo-accordion accordionjs m-0" data-active-index="false">

        <!-- Section 1 -->
        <li class="acc_section">
            <div class="acc_head"><h3>Rejected Feedback</h3></div>
            <div class="acc_content" style="display: none;"><div class="list-group">
                    <?php $__currentLoopData = $job_offer_remarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remarks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                        <div class="d-flex w-100 justify-content-between">

                            <?php if($remarks->applicant_id != null): ?>
                            <h5 class="mb-1"><?php echo e($remarks->jobOfferApplicant->full_name); ?></h5>
                            <?php elseif($remarks->user_id != null): ?>
                                <h5 class="mb-1"><?php echo e($remarks->user->full_name); ?></h5>
                            <?php endif; ?>
                            <small><?php echo e(getNoDays($remarks->created_at, today())-1); ?> days ago</small>
                        </div>
                        <p class="mb-1"><?php echo e($remarks->comments); ?></p>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <br>
                <a href="<?php echo e(route('job_offer.print', $job_offer->uuid)); ?>" class="btn btn-warning btn-sm"><i class="fa fa-reply"></i> Reply</a>
            </div>

        </li>

    </ul>

    <?php endif; ?>
    <br>
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
                                <strong><?php echo e($job_offer->date_of_arrival); ?></strong>
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