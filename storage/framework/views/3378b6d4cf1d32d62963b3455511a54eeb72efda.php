<?php $__env->startSection('content'); ?>
    <div class="align-content-center" style="background-color: rgb(238, 241, 248); height: 40px;">
        <div class="row text-center" style="font-size: large">
            <span class="col-12 text-center font-weight-bold" style="margin-top: 10px"><b>Hire Requisition </b></span>
        </div>
    </div>

    <!-- start: page -->
   
    <div class="row mb-2">
        <div class="col-lg-12">
            <?php echo $__env->make('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
 
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title"> <?php echo e($_advertisement->title); ?> </h3>
                        <div class="card-title">
                           
                        Number: <span> <?php echo e($_advertisement->number); ?> </span> 
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="demo-accordion accordionjs m-0" data-active-index="false">
                        Department: <span> <?php echo $_advertisement->description; ?> </span> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
   


    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/humanResource/hireRequisition/advertisement/display/show.blade.php ENDPATH**/ ?>