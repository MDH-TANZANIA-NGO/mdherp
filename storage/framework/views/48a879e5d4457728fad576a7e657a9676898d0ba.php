<?php $__env->startSection('content'); ?>


    


    <?php echo $__env->make('project.form.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    


    


<div class="col-lg-12 col-md-12">
    
        <div class="card">

            <div class="card-header" style="background-color: rgb(238, 241, 248)">
                <div class="row text-center">
                    <span class="col-12 text-center font-weight-bold">List of Projects</span>
                    </div>

                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    </div>
                
            </div>

        <div class="card-body">
            <div class="row">

                <div class="col-12" >

            <div class="table-responsive">
                <?php echo $__env->make('project.datatables.all', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
                </div>
        </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/william/Code/mdherp/resources/views/project/index.blade.php ENDPATH**/ ?>