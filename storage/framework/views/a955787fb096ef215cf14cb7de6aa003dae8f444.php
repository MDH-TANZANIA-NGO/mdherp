<div class="card">
    <div class="card-header">
        <h3 class="card-title">INTERVIEW QUESTIONS</h3>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th> #</th>
                            <th> Question </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_questions = 0; ?>
                        <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td> <?php echo e(($key+1)); ?></td>
                            <td> <?php echo e($question->question); ?> </td>
                        </tr>
                        <?php $total_questions = ($key + 1); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/interview/question/show.blade.php ENDPATH**/ ?>