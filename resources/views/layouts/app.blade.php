<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="MDH - ERP" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />


    <!-- Title -->
{{--    <title>MDH - ERP</title>--}}

    <!--Favicon -->
{{--    <link rel="icon" href="mdh/images/brand/favicon.ico" type="image/x-icon"/>--}}
<!-- Data table -->

@stack('before-styles')
<!-- Style css -->
    {{ Html::style(url('mdh/css/style.css')) }}


{{--    text editor--}}
{{ Html::style(url('mdh/plugins/wysiwyag/richtext.css')) }}

        <!-- Date Picker css -->
    {!! Html::script(url('mdh/plugins/date-picker/date-picker.css')) !!}

    {{ Html::style(url('mdh/plugins/horizontal-menu/horizontal.css')) }}

    <!--Sidemenu css -->
    {{ Html::style(url('mdh/plugins/sidemenu/combine-menu/combine-menu.css')) }}

    <!-- P-scroll bar css-->
    {{ Html::style(url('mdh/plugins/p-scrollbar/p-scrollbar.css')) }}

    <!-- Data table css -->
        {{ Html::style(url('mdh/plugins/datatable/dataTables.bootstrap4.min.css')) }}

        <!---Icons css-->
        {{ Html::style(url('mdh/plugins/web-fonts/icons.css')) }}
        {{ Html::style(url('mdh/plugins/web-fonts/font-awesome/font-awesome.min.css')) }}
        {{ Html::style(url('mdh/plugins/web-fonts/plugin.css')) }}

<!-- Select2 css -->
{{ Html::style(url('mdh/plugins/select2/select2.min.css')) }}

    <!-- Skin css-->
        {{ Html::style(url('mdh/css/skins.css')) }}

<!-- fileupload css-->
    {{ Html::style(url('mdh/plugins/fileupload/css/dropify.css')) }}

    <!-- Custom css -->
        {{ Html::style(url('mdh/css/custom.css')) }}
<!-- Accordion Css -->
    {{ Html::style(url('mdh/plugins/accordion/accordion.css')) }}



{{--    <link href="mdh/css/style.css" rel="stylesheet" />--}}

{{--    <!--Horizontal css -->--}}
{{--    <link id="effect" href="mdh/plugins/horizontal-menu/dropdown-effects/fade-up.css" rel="stylesheet" />--}}
{{--    <link href="mdh/plugins/horizontal-menu/horizontal.css" rel="stylesheet" />--}}

{{--    <!--Sidemenu css -->--}}
{{--    <link href="mdh/plugins/sidemenu/combine-menu/combine-menu.css" rel="stylesheet">--}}

{{--    <!-- P-scroll bar css-->--}}
{{--    <link href="mdh/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />--}}

{{--    <!---Icons css-->--}}
{{--    <link href="mdh/plugins/web-fonts/icons.css" rel="stylesheet" />--}}
{{--    <link href="mdh/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">--}}
{{--    <link href="mdh/plugins/web-fonts/plugin.css" rel="stylesheet" />--}}

{{--    <!-- Select2 css -->--}}
{{--    <link href="mdh/plugins/select2/select2.min.css" rel="stylesheet" />--}}

{{--    <!-- Time picker css -->--}}
{{--    <link href="mdh/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />--}}

{{--    <!-- Date Picker css -->--}}
{{--    <link href="mdh/plugins/date-picker/date-picker.css" rel="stylesheet" />--}}

{{--    <!-- File Uploads css-->--}}
{{--    <link href="mdh/plugins/fileupload/css/dropify.css" rel="stylesheet" type="text/css" />--}}

{{--    <!-- Skin css-->--}}
{{--    <link href="mdh/css/skins.css" rel="stylesheet" />--}}

    @stack('after-styles')

{{--<script>--}}
{{--    // $('.fromdate').datepicker({--}}
{{--    //     dateFormat: 'yy-mm-dd',--}}
{{--    //     changeMonth: true,--}}
{{--    //     changeYear: true,--}}
{{--    // });--}}
{{--    // $('.todate').datepicker({--}}
{{--    //     dateFormat: 'yy-mm-dd',--}}
{{--    //     changeMonth: true,--}}
{{--    //     changeYear: true,--}}
{{--    // });--}}
{{--    // $('#from').datepicker().bind("change", function () {--}}
{{--    //     var minValue = $(this).val();--}}
{{--    //     minValue = $.datepicker.parseDate("yy-mm-dd", minValue);--}}
{{--    //     $('#to').datepicker("option", "minDate", minValue);--}}
{{--    //     calculate();--}}
{{--    // });--}}
{{--    // $('#to').datepicker().bind("change", function () {--}}
{{--    //     var maxValue = $(this).val();--}}
{{--    //     maxValue = $.datepicker.parseDate("yy-mm-dd", maxValue);--}}
{{--    //     $('#from').datepicker("option", "maxDate", maxValue);--}}
{{--    //     calculate();--}}
{{--    // });--}}

{{--    // function calculate() {--}}
{{--    //     var d1 = $('#from').datepicker('getDate');--}}
{{--    //     var d2 = $('#to').datepicker('getDate');--}}
{{--    //     var oneDay = 24*60*60*1000;--}}
{{--    //     var diff = 0;--}}
{{--    //     if (d1 && d2) {--}}
{{--    //--}}
{{--    //         diff = Math.round(Math.abs((d2.getTime() - d1.getTime())/(oneDay)));--}}
{{--    //     }--}}
{{--    //     $('.calculated').val(diff);--}}
{{--    // }--}}
{{--</script>--}}
    {!! Html::script(url('dist/sweetalert.min.js')) !!}


</head>

<body class="app sidebar-mini" style="background-color: #f5f5f5">

@include('sweet::alert')
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




{{--<!-- Bootstrap4 js-->--}}


{{--<!--Othercharts js-->--}}


{{--<!--Horizontal js-->--}}


{{--<!--Sidemenu js-->--}}


{{--<!-- P-scroll js-->--}}


{{--<!-- Datepicker js -->--}}



{{--<!-- Datepicker js -->--}}


{{--<!--Select2 js -->--}}


{{--<!-- Custom js-->--}}



{{--<!-- File uploads js -->--}}
{{-- <script src="mdh/plugins/fileupload/js/dropify.js"></script>--}}
{{--<script src="mdh/js/filupload.js"></script>--}}

@stack('before-scripts')

<script>
    var base_url = "{!! url("/") !!}";
</script>
<!-- Jquery js-->
{!! Html::script(url('mdh/js/vendors/jquery-3.4.0.min.js')) !!}

<!-- Data tables js-->
{!! Html::script(url('mdh/plugins/datatable/jquery.dataTables.min.js')) !!}
{{--{!! Html::script(url('mdh/plugins/datatable/dataTables.bootstrap4.min.js')) !!}--}}
{{--{!! Html::script(url('mdh/js/datatable.js')) !!}--}}

<!-- Bootstrap4 js-->
{!! Html::script(url('mdh/plugins/bootstrap/popper.min.js')) !!}
{!! Html::script(url('mdh/plugins/bootstrap/js/bootstrap.min.js')) !!}

<!--Othercharts js-->
{!! Html::script(url('mdh/plugins/othercharts/jquery.sparkline.min.js')) !!}

<!-- Circle-progress js-->
{!! Html::script(url('mdh/js/vendors/circle-progress.min.js')) !!}

<!-- Jquery-rating js-->
{!! Html::script(url('mdh/plugins/rating/jquery.rating-stars.js')) !!}

<!--Horizontal js-->
{!! Html::script(url('mdh/plugins/horizontal-menu/horizontal.js')) !!}

<!--Sidemenu js-->
{!! Html::script(url('mdh/plugins/sidemenu/combine-menu/combine-menu.js')) !!}

<!-- P-scroll js-->
{!! Html::script(url('mdh/plugins/p-scrollbar/p-scrollbar.js')) !!}
{!! Html::script(url('mdh/plugins/p-scrollbar/p-scroll1.js')) !!}
{{--{!! Html::script(url('mdh/plugins/p-scrollbar/p-scroll1.js')) !!}--}}

<!--Select2 js -->
{!! Html::script(url('mdh/plugins/select2/select2.full.min.js')) !!}
{!! Html::script(url('mdh/js/select2.js')) !!}

<!-- Timepicker js -->
{{--<script src="mdh/plugins/time-picker/jquery.timepicker.js"></script>--}}
{{--<script src="mdh/plugins/time-picker/toggles.min.js"></script>--}}

<!-- Datepicker js -->
{!! Html::script(url('mdh/plugins/date-picker/date-picker.js')) !!}
{!! Html::script(url('mdh/plugins/date-picker/jquery-ui.js')) !!}
{!! Html::script(url('mdh/plugins/input-mask/jquery.maskedinput.js')) !!}

<!-- File uploads js -->
{!! Html::script(url('mdh/plugins/fileupload/js/dropify.js')) !!}
{!! Html::script(url('mdh/js/filupload.js')) !!}


{!! Html::script(url('mdh/plugins/wysiwyag/jquery.richtext.js')) !!}
{!! Html::script(url('mdh/js/form-editor.js')) !!}
@stack('after-scripts')


<!-- Custom js-->
{!! Html::script(url('mdh/js/custom.js')) !!}

<!--Accordion-Wizard-Form js-->
<script src="mdh/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script>
<script src="mdh/js/form-wizard.js"></script>



</body>

</html>
