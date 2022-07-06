<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

    <!-- Title -->
    <title><?php echo $__env->yieldPushContent('title'); ?></title>

    <!--Favicon -->


    <!-- Style css -->
    <?php echo e(Html::style(url('mdh/css/style.css'))); ?>


    <!---Icons css-->
    <?php echo e(Html::style(url('mdh/plugins/web-fonts/icons.css'))); ?>

    <?php echo e(Html::style(url('mdh/plugins/web-fonts/font-awesome/font-awesome.min.css'))); ?>

    <?php echo e(Html::style(url('mdh/plugins/web-fonts/plugin.css'))); ?>


</head>
<body class="h-100vh">

<?php echo $__env->yieldContent('content'); ?>

<!-- Jquery js-->
<?php echo Html::script(url('mdh/js/vendors/jquery-3.4.0.min.js')); ?>


<!-- Bootstrap4 js-->
<?php echo Html::script(url('mdh/js/vendors/popper.min.js')); ?>

<?php echo Html::script(url('mdh/js/vendors/bootstrap.min.js')); ?>


</body>
</html>
<?php /**PATH /Users/william/Code/mdherp/resources/views/layouts/error.blade.php ENDPATH**/ ?>