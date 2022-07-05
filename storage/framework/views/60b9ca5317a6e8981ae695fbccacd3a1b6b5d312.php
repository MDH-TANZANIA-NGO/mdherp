<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Job Offer Details</h3>
                    <div class="card-options">
                        <a href="<?php echo e(route('job_offer.print', $job_offer->uuid)); ?>" class="btn btn-primary btn-sm float-right"><i class="fa fa-print"></i> Print</a>
                        <?php if($job_offer->status == null): ?>
                            <a href="<?php echo e(route('job_offer.acceptingOffer', $job_offer->uuid)); ?>" class="btn btn-success btn-sm" style="margin-left: 2%"><i class="fa fa-check-circle"></i> Accept</a>
                            <button type="button"class="btn btn-instagram btn-sm" data-toggle="modal" data-target="#exampleModal" style="margin-left: 2%"><i class="fa fa-ban"></i> Reject</button>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Job offer remarks</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php echo Form::open(['route' => ['job_offer.rejectOffer',$job_offer->uuid], 'method'=>'PUT']); ?>

                                <div class="form-group">
                                    <label class="form-label">Why do you reject offer?</label>
                                    <textarea class="form-control" name="comments" rows="7" placeholder="text here.."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="">
                        <h4 class="mb-1"><strong>Congratulation! <?php echo e($job_offer->interviewApplicant->applicant->full_name); ?>,</strong>,</h4>
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
                                                        <div class="card-header">
                                                            <h3 class="card-title">Other benefits</h3>





                                                        </div>
                            <div class="card-body">
                                <?php echo htmlspecialchars_decode($job_offer->details); ?>

                            </div>
                        </div>
                        <p class="text-muted text-center " style="margin-left: 30%" >Thank you choosing working with us! For any inquiry please call us 0758698022</p>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    

                    

                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/HumanResource/JobOffer/acceptingoffer.blade.php ENDPATH**/ ?>