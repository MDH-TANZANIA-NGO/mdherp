<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="MDH - ERP" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>

    <!-- Title -->
    <title>MDH - ERP</title>

    <!--Favicon -->
    <link rel="icon" href="mdh/images/brand/favicon.ico" type="image/x-icon"/>

    <!-- Style css -->
{{--{{ Html::style(url('mdh/css/style.css')) }}--}}


{{--    <!-- Date Picker css -->--}}
{{--{!! Html::script(url('mdh/plugins/date-picker/date-picker.css')) !!}--}}

{{--{{ Html::style(url('mdh/plugins/horizontal-menu/horizontal.css')) }}--}}

{{--<!--Sidemenu css -->--}}
{{--{{ Html::style(url('mdh/plugins/sidemenu/combine-menu/combine-menu.css')) }}--}}

{{--<!-- P-scroll bar css-->--}}
{{--{{ Html::style(url('mdh/plugins/p-scrollbar/p-scrollbar.css')) }}--}}

{{--<!-- Data table css -->--}}
{{--    {{ Html::style(url('mdh/plugins/datatable/dataTables.bootstrap4.min.css')) }}--}}

{{--    <!---Icons css-->--}}
{{--    {{ Html::style(url('mdh/plugins/web-fonts/icons.css')) }}--}}
{{--    {{ Html::style(url('mdh/plugins/web-fonts/font-awesome/font-awesome.min.css')) }}--}}
{{--    {{ Html::style(url('mdh/plugins/web-fonts/plugin.css')) }}--}}

{{--<!-- Skin css-->--}}
{{--    {{ Html::style(url('mdh/css/skins.css')) }}--}}



{{--<!-- Select2 css -->--}}
{{--{{ Html::style(url('mdh/plugins/select2/select2.min.css')) }}--}}

    @stack('before-styles')

    <link href="mdh/css/style.css" rel="stylesheet" />

    <!--Horizontal css -->
    <link id="effect" href="mdh/plugins/horizontal-menu/dropdown-effects/fade-up.css" rel="stylesheet" />
    <link href="mdh/plugins/horizontal-menu/horizontal.css" rel="stylesheet" />

    <!--Sidemenu css -->
    <link href="mdh/plugins/sidemenu/combine-menu/combine-menu.css" rel="stylesheet">

    <!-- P-scroll bar css-->
    <link href="mdh/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

    <!---Icons css-->
    <link href="mdh/plugins/web-fonts/icons.css" rel="stylesheet" />
    <link href="mdh/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
    <link href="mdh/plugins/web-fonts/plugin.css" rel="stylesheet" />

    <!-- Select2 css -->
    <link href="mdh/plugins/select2/select2.min.css" rel="stylesheet" />

    <!-- Time picker css -->
    <link href="mdh/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />

    <!-- Date Picker css -->
    <link href="mdh/plugins/date-picker/date-picker.css" rel="stylesheet" />

    <!-- File Uploads css-->
    <link href="mdh/plugins/fileupload/css/dropify.css" rel="stylesheet" type="text/css" />

    <!-- Skin css-->
    <link href="mdh/css/skins.css" rel="stylesheet" />

    @stack('after-styles')



</head>

<body class="app sidebar-mini" style="background-color: #f5f5f5">

<!---Global-loader-->
<div id="global-loader" >
    <img src=" {{ asset('mdh/images/svgs/loader.svg') }}" alt="loader">
</div>

<div class="page comb-page" style="background-color: #f5f5f5">
    <div class="page-main" style="background-color: #f5f5f5">

    @if(!access()->guest())
        {{--Header--}}
            @include('includes.navigation.header')
        {{--Header closed--}}

        <!--aside open-->
        @include('includes.navigation.aside')
        <!--aside closed-->
        @endif

        <div class="app-content page-body">

            <!-- Horizontal-menu -->
        {{--            @include('includes.navigation.horizontal')--}}
        <!-- Horizontal-menu end -->

            {{--main body--}}

            <div class="side-app">

                <!--Page header-->
            {{--                @include('includes.page_header')--}}
            <!--End Page header-->

                <div class="col-md-12 col-lg-12 col-sm-12 col-xl-12" style="margin-top: -40px">
                    @yield('content')
                </div>


            </div>


            {{--main body closed--}}

        </div><!-- end app-content-->
    </div>

{{--    <footer class="footer">--}}
{{--        <div class="container">--}}
{{--            <div class="row align-items-center flex-row-reverse">--}}
{{--                <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">--}}
{{--                    Copyright © 2021 <a href="mdh.or.tz">MDH</a>. All rights reserved.--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </footer>--}}
    <!-- End Footer-->

</div>

<!-- Back to top -->
<a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>

{{--<!-- Jquery js-->--}}
{{--{!! Html::script(url('mdh/js/vendors/jquery-3.4.0.min.js')) !!}--}}

{{--<!-- Data tables js-->--}}
{{--{!! Html::script(url('mdh/plugins/datatable/jquery.dataTables.min.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/datatable/dataTables.bootstrap4.min.js')) !!}--}}
{{--{!! Html::script(url('mdh/js/datatables.js')) !!}--}}

{{--<!-- Bootstrap4 js-->--}}
{{--{!! Html::script(url('mdh/plugins/bootstrap/popper.min.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/bootstrap/js/bootstrap.min.js')) !!}--}}

{{--<!--Othercharts js-->--}}
{{--{!! Html::script(url('mdh/plugins/othercharts/jquery.sparkline.min.js')) !!}--}}

{{--<!-- Circle-progress js-->--}}
{{--{!! Html::script(url('mdh/js/vendors/circle-progress.min.js')) !!}--}}

{{--<!-- Jquery-rating js-->--}}
{{--{!! Html::script(url('mdh/plugins/rating/jquery.rating-stars.js')) !!}--}}

{{--<!--Horizontal js-->--}}
{{--{!! Html::script(url('mdh/plugins/horizontal-menu/horizontal.js')) !!}--}}

{{--<!--Sidemenu js-->--}}
{{--{!! Html::script(url('mdh/plugins/sidemenu/combine-menu/combine-menu.js')) !!}--}}

{{--<!-- P-scroll js-->--}}
{{--{!! Html::script(url('mdh/plugins/p-scrollbar/p-scrollbar.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/p-scrollbar/p-scroll1.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/p-scrollbar/p-scroll1.js')) !!}--}}

{{--<!-- Datepicker js -->--}}
{{--{!! Html::script(url('mdh/plugins/date-picker/date-picker.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/date-picker/jquery-ui.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/input-mask/jquery.maskedinput.js')) !!}--}}


{{--<!-- Datepicker js -->--}}
{{--{!! Html::script(url('mdh/plugins/date-picker/date-picker.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/date-picker/jquery-ui.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/input-mask/jquery.maskedinput.js')) !!}--}}

{{--<!--Select2 js -->--}}
{{--{!! Html::script(url('mdh/plugins/select2/select2.full.min.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/js/select2.js')) !!}--}}

{{--<!-- Custom js-->--}}
{{--{!! Html::script(url('mdh/js/custom.js')) !!}--}}


{{--<!-- File uploads js -->--}}
{{-- <script src="mdh/plugins/fileupload/js/dropify.js"></script>--}}
{{--<script src="mdh/js/filupload.js"></script>--}}

@stack('before-scripts')
<!-- Jquery js-->
<script src="mdh/js/vendors/jquery-3.4.0.min.js"></script>

<!-- Bootstrap4 js-->
<script src="mdh/plugins/bootstrap/popper.min.js"></script>
<script src="mdh/plugins/bootstrap/js/bootstrap.min.js"></script>

<!--Othercharts js-->
<script src="mdh/plugins/othercharts/jquery.sparkline.min.js"></script>

<!-- Circle-progress js-->
<script src="mdh/js/vendors/circle-progress.min.js"></script>

<!-- Jquery-rating js-->
<script src="mdh/plugins/rating/jquery.rating-stars.js"></script>

<!--Horizontal js-->
<script src="mdh/plugins/horizontal-menu/horizontal.js"></script>

<!--Sidemenu js-->
<script src="mdh/plugins/sidemenu/combine-menu/combine-menu.js"></script>

<!-- P-scroll js-->
<script src="mdh/plugins/p-scrollbar/p-scrollbar.js"></script>
<script src="mdh/plugins/p-scrollbar/p-scroll1.js"></script>
<script src="mdh/plugins/p-scrollbar/p-scroll1.js"></script>

<!--Select2 js -->
<script src="mdh/plugins/select2/select2.full.min.js"></script>
<script src="mdh/js/select2.js"></script>

<!-- Timepicker js -->
<script src="mdh/plugins/time-picker/jquery.timepicker.js"></script>
<script src="mdh/plugins/time-picker/toggles.min.js"></script>

<!-- Datepicker js -->
<script src="mdh/plugins/date-picker/date-picker.js"></script>
<script src="mdh/plugins/date-picker/jquery-ui.js"></script>
<script src="mdh/plugins/input-mask/jquery.maskedinput.js"></script>

<!-- File uploads js -->
<script src="mdh/plugins/fileupload/js/dropify.js"></script>
<script src="mdh/js/filupload.js"></script>

@stack('after-scripts')


<!-- Custom js-->
<script src="mdh/js/custom.js"></script>


</body>
</html>
