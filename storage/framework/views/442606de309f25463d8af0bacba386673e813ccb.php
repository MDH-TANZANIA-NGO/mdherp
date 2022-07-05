<!-- <?php echo e($hireRequisitionJobs); ?> -->
<div class="row">
    <div class="col-lg-12">
            <form action="<?php echo e(route('hirerequisition.submit',$uuid)); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row hire_requisition_list">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                            </div>
                            <div class="card-body">
                                <ul class="demo-accordion accordionjs m-0" data-active-index="false">
                                <?php echo $__env->renderEach('humanResource.hireRequisition._parent.display.hr_job', $hireRequisitionJobs, 'job'); ?>
                                </ul>
                                <div class="pull-right mt-3">
                                    <button type="button" id="add_requisition" value="submit" class="btn btn-inline-block btn-azure"> <i class="fa fa-plus"></i> Add </button>
                                    <button type="submit" name="submit_job_requisition" value="submit" class="btn btn-inline-block btn-azure"> <i class="fa fa-paper-plane"></i> Submit For Approval</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>

<?php $__env->startPush('after-scripts'); ?>
    <script>
        $(document).ready(function () {
            $("#access_processing").DataTable({
                destroy: true,
                retrieve: true,
                "responsive": true,
                "autoWidth": false,
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /Users/william/Code/mdherp/resources/views/HumanResource/HireRequisition/_parent/datatables/index.blade.php ENDPATH**/ ?>