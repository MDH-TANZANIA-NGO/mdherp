
<?php $__env->startSection('content'); ?>
<div class="row mb-2">
    <div class="col-lg-12">
        <?php echo $__env->make('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">INTERVIEW REPORT</h3>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th> #</th>
                            <th> Name </th>
                            <th> TECHNICAL STAFF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_questions = 0; ?>
                      
                    </tbody>
                </table>
                <?php echo $__env->renderEach('HumanResource.Interview.report.interveiw_list', $interviews, 'interview'); ?>
                <?php echo $__env->make('HumanResource.Interview.report.panelist_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('HumanResource.Interview.report.recommendation_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/report/show.blade.php ENDPATH**/ ?>