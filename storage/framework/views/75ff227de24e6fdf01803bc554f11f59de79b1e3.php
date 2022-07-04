
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">TOTAL APPLICANTS:  <?php echo e($applicants->count()); ?> </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">INTERVIEW TYPE:  <?php echo e($interview_type->name); ?> </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">PENDING :  <?php echo e($pending); ?> </span>
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">COMPLETED :  <?php echo e($completed); ?> </span>
            <span class="tag tag-rounded pull-right"> <input type="submit" value="SUBMIT FOR REPORT" class="btn btn-primary"></span>
           
		</div>
    </div>
</div>
<div class="row">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">APPLICANT LIST</h3>
        </div>
        <div class="card-body">
            <?php echo Form::open(['route' => 'interview.question.storeMarks']); ?>

            <input type="hidden" value="<?php echo e($interview->id); ?>" name="interview_id">
             
            <div class="row mt-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th>  Qno     </th>
                                <th>  Applicant </th>
                                <th>  Number </th>
                                <th>  Marks  </th>
                                <th>  Status   </th>
                                <th>  Action   </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_questions = 0; ?>
                            <?php $__currentLoopData = $applicants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$applicant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <tr>
                                <td> <?php echo e(($key+1)); ?></td>
                                <td> <?php echo e($applicant->full_name); ?> </td>
                                <td> <?php echo e($applicant->number); ?> </td>
                                <td> <?php echo e($applicant->marks); ?> </td>
                                <td>      </td>
                             
                                <td><a data-interview_id = "<?php echo e($interview->id); ?>" data-applicant_id="<?php echo e($applicant->id); ?>" data-toggle="modal" data-target="#edit" data-whatever="@mdo" href="#"> Add Marks </a></td>
                            </tr>
                            <?php $total_questions = ($key+1); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                    <input type="hidden" name="total_questions" value="<?php echo e($total_questions); ?>">
                </div>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Marks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo Form::open(['route' => 'interview.question.storeMarks','method'=> 'post']); ?>

            <div class="modal-body">
            <div class="row mt-3">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <tr>
                                <th> Qno</th>
                                <th>Question</th>
                                <th>Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total_questions = 0; ?>
                            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <tr>
                                <td> <?php echo e(($key+1)); ?></td>
                                <td> <?php echo e($question->question); ?> </td>
                                <td>
                                     <input type="number" name="marks<?php echo e(($key+1)); ?>"  required>
                                     <input type="hidden" value="<?php echo e($question->id); ?>" name="question<?php echo e(($key+1)); ?>"  required>
                                </td>
                            </tr>
                            <?php $total_questions = ($key+1); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                    <input type="hidden" name="total_questions" value="<?php echo e($total_questions); ?>">
                    <input type="hidden" name="applicant_id" id="applicant_id" value=""  required/>
                    <input type="hidden" name="interview_id" id="interview_id" value=""  required/>
                    
                </div>
            </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">submit</button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>

<?php $__env->startPush('after-scripts'); ?>
<script>
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var content = button.data('content'); // Button that triggered the modal
        var id = button.data('id'); // Button that triggered the modal
        var applicant_id = button.data('applicant_id'); // Button that triggered the modal
        var interview_id = button.data('interview_id'); // Button that triggered the modal
        $("#question").val(content);
        $("#question_id").val(id);
        $("#applicant_id").val(applicant_id);
        $("#interview_id").val(interview_id);
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mdherp\resources\views/HumanResource/Interview/question_marks/index.blade.php ENDPATH**/ ?>