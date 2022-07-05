<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="MDH - ERP" name="description">
    <meta content="Management For Development and Health" name="author">
    <meta name="keywords" content="Mimosa"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />


    <!-- Title -->


    <!--Favicon -->

<!-- Data table -->

<?php echo $__env->yieldPushContent('before-styles'); ?>
<!-- Style css -->
    <?php echo e(Html::style(url('mdh/css/style.css'))); ?>




<?php echo e(Html::style(url('mdh/plugins/wysiwyag/richtext.css'))); ?>

<?php echo e(Html::style(url('mdh/css/summernote.min.css'))); ?>


        <!-- Date Picker css -->
    <?php echo Html::script(url('mdh/plugins/date-picker/date-picker.css')); ?>


    <?php echo e(Html::style(url('mdh/plugins/horizontal-menu/horizontal.css'))); ?>


    <!--Sidemenu css -->
    <?php echo e(Html::style(url('mdh/plugins/sidemenu/combine-menu/combine-menu.css'))); ?>


    <!-- P-scroll bar css-->
    <?php echo e(Html::style(url('mdh/plugins/p-scrollbar/p-scrollbar.css'))); ?>


    <!-- Data table css -->
        <?php echo e(Html::style(url('mdh/plugins/datatable/dataTables.bootstrap4.min.css'))); ?>


        <!---Icons css-->
        <?php echo e(Html::style(url('mdh/plugins/web-fonts/icons.css'))); ?>

        <?php echo e(Html::style(url('mdh/plugins/web-fonts/font-awesome/font-awesome.min.css'))); ?>

        <?php echo e(Html::style(url('mdh/plugins/web-fonts/plugin.css'))); ?>


<!-- Select2 css -->
<?php echo e(Html::style(url('mdh/plugins/select2/select2.min.css'))); ?>


    <!-- Skin css-->
        <?php echo e(Html::style(url('mdh/css/skins.css'))); ?>


<!-- fileupload css-->
    <?php echo e(Html::style(url('mdh/plugins/fileupload/css/dropify.css'))); ?>


    <!-- Custom css -->
        <?php echo e(Html::style(url('mdh/css/custom.css'))); ?>

<!-- Accordion Css -->
    <?php echo e(Html::style(url('mdh/plugins/accordion/accordion.css'))); ?>


   <!-- smartwizard js -->
   <!-- <?php echo Html::style(url('mdh/css/forn-wizard.min.css')); ?> -->
    <?php echo Html::style(url('mdh/css/smart_wizard.min.css')); ?>

    <?php echo Html::style(url('mdh/css/smart_wizard_theme_circles.min.css')); ?>

    <?php echo e(Html::style(url('mdh/plugins/notify/css/notifIt.css'))); ?>


    <?php echo $__env->yieldPushContent('after-styles'); ?>
    <?php echo Html::script(url('dist/sweetalert.min.js')); ?>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>


</head>

<body class="app sidebar-mini" style="background-color: #f5f5f5">

<?php echo $__env->make('sweet::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!---Global-loader-->
<div id="global-loader" >
    <img src=" <?php echo e(asset('mdh/images/svgs/loader.svg')); ?>" alt="loader">
</div>

<div class="page comb-page" style="background-color: #f5f5f5">
    <div class="page-main" style="background-color: #f5f5f5">


        
            <?php echo $__env->make('includes.navigation.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        

        <!--aside open-->
        <?php echo $__env->make('includes.navigation.aside2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--aside closed-->


        <div class="app-content page-body">

            <!-- Horizontal-menu -->
        
        <!-- Horizontal-menu end -->

            

            <div class="side-app">

                <!--Page header-->
            
            <!--End Page header-->

                <div class="col-md-12 col-lg-12 col-sm-12 col-xl-12" style="margin-top: -40px">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>


            </div>


            

        </div><!-- end app-content-->
    </div>










    <!-- End Footer-->

</div>

<!-- Back to top -->
<a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>

<?php echo $__env->yieldPushContent('before-scripts'); ?>

<script>
    var base_url = "<?php echo url("/"); ?>";
</script>
<!-- Jquery js-->
<?php echo Html::script(url('mdh/js/vendors/jquery-3.4.0.min.js')); ?>


<!-- Data tables js-->
<?php echo Html::script(url('mdh/plugins/datatable/jquery.dataTables.min.js')); ?>


<?php echo Html::script(url('mdh/plugins/datatable/dataTables.bootstrap4.min.js')); ?>

<?php echo Html::script(url('mdh/js/datatables.js')); ?>


<!-- Bootstrap4 js-->
<?php echo Html::script(url('mdh/plugins/bootstrap/popper.min.js')); ?>

<?php echo Html::script(url('mdh/plugins/bootstrap/js/bootstrap.min.js')); ?>


<!--Othercharts js-->
<?php echo Html::script(url('mdh/plugins/othercharts/jquery.sparkline.min.js')); ?>


<!-- Circle-progress js-->
<?php echo Html::script(url('mdh/js/vendors/circle-progress.min.js')); ?>


<!-- Jquery-rating js-->
<?php echo Html::script(url('mdh/plugins/rating/jquery.rating-stars.js')); ?>


<!--Horizontal js-->
<?php echo Html::script(url('mdh/plugins/horizontal-menu/horizontal.js')); ?>


<!--Sidemenu js-->
<?php echo Html::script(url('mdh/plugins/sidemenu/combine-menu/combine-menu.js')); ?>


<!-- P-scroll js-->
<?php echo Html::script(url('mdh/plugins/p-scrollbar/p-scrollbar.js')); ?>

<?php echo Html::script(url('mdh/plugins/p-scrollbar/p-scroll1.js')); ?>



<!--Select2 js -->
<?php echo Html::script(url('mdh/plugins/select2/select2.full.min.js')); ?>

<?php echo Html::script(url('mdh/js/select2.js')); ?>


<!-- Timepicker js -->



<!-- Datepicker js -->


<?php echo Html::script(url('mdh/plugins/input-mask/jquery.maskedinput.js')); ?>


<!-- File uploads js -->
<?php echo Html::script(url('mdh/plugins/fileupload/js/dropify.js')); ?>

<?php echo Html::script(url('mdh/js/filupload.js')); ?>



<?php echo Html::script(url('mdh/plugins/wysiwyag/jquery.richtext.js')); ?>

<?php echo Html::script(url('mdh/js/form-editor.js')); ?>



<?php echo Html::script(url('mdh/js/popover.js')); ?>

<!-- Notifications js -->
<?php echo Html::script(url('mdh/plugins/notify/js/rainbow.js')); ?>

<?php echo Html::script(url('mdh/plugins/notify/js/sample.js')); ?>

<?php echo Html::script(url('mdh/plugins/notify/js/notifIt.js')); ?>



<!-- Custom js-->
<?php echo Html::script(url('mdh/js/custom.js')); ?>


<!--Accordion-Wizard-Form js-->
<!-- <script src="mdh/plugins/accordion/accordion.min.js"></script> -->
{<?php echo Html::script(url('mdh/plugins/accordion/accordion.min.js')); ?>}


<?php echo $__env->yieldPushContent('in-scripts'); ?>
<!-- AdminLTE App -->


<?php echo Html::script(url('mdh/js/summernote.min.js')); ?>


<?php echo Html::script(url('plugins/maskmoney/jquery.maskMoney.js')); ?>


<!-- smartwizard js -->
<?php echo Html::script(url('mdh/js/jquery.smartWizard.min.js')); ?>

<?php echo Html::script(url('mdh/js/fromwizard.js')); ?>


<script>
    $(document).ready(function () {
        $('.textarea').summernote({
            height: 140,
            spellCheck: true,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen']],
            ],
        });

        $(".money").maskMoney({
            precision: 2,
            allowZero: false,
            affixesStay: false,
            thousands: '',
        });
    });

    $(".demo-accordion").accordionjs();

</script>

<?php echo $__env->yieldPushContent('after-scripts'); ?>



</body>

</html>
<?php /**PATH /Users/frank/Documents/Projects/mdherp2/resources/views/layouts/app2.blade.php ENDPATH**/ ?>