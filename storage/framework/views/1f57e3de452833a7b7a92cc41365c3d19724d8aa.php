<div class="card">
    <div class="card-header">
        <h3 class="card-title">PANELIST LIST</h3>
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
                        <?php $__currentLoopData = $panelists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$panelist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <?php echo e(($key+1)); ?></td>
                            <td> <?php echo e($panelist->full_name); ?> </td>
                            
                            <td>
                                <?php if(!Session::has('msg')): ?> <input type="radio" name="technical_staff" value="<?php echo e($panelist->id); ?>"> <?php endif; ?>
                            </td>
                        </tr>
                        <?php $total_questions = ($key + 1); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <input type="hidden" name="total_questions" value="<?php echo e($total_questions); ?>">
                <input type="hidden" name="applicant_id" id="applicant_id" value="" required />
                <input type="hidden" name="interview_id" id="interview_id" value="" required />
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/frank/Documents/Projects/mdherp2/resources/views/HumanResource/interview/panelist/show.blade.php ENDPATH**/ ?>