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
{{ Html::style(url('mdh/css/style.css')) }}

<!--Horizontal css -->
    <link id="effect" href="mdh/plugins/horizontal-menu/dropdown-effects/fade-up.css" rel="stylesheet" />

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

<!-- Skin css-->
    {{ Html::style(url('mdh/css/skins.css')) }}


{{-- Date picker --}}
{{ Html::style(url('mdh/plugins/date-picker/date-picker.css')) }}

<!-- Select2 css -->
{{ Html::style(url('mdh/plugins/select2/select2.min.css')) }}
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

<!-- Jquery js-->
{!! Html::script(url('mdh/js/vendors/jquery-3.4.0.min.js')) !!}

<!-- Data tables js-->
{!! Html::script(url('mdh/plugins/datatable/jquery.dataTables.min.js')) !!}
{!! Html::script(url('mdh/plugins/datatable/dataTables.bootstrap4.min.js')) !!}
{!! Html::script(url('mdh/js/datatables.js')) !!}

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
{!! Html::script(url('mdh/plugins/p-scrollbar/p-scroll1.js')) !!}

<!-- Custom js-->
{!! Html::script(url('mdh/js/custom.js')) !!}


<!-- Datepicker js -->
{!! Html::script(url('mdh/plugins/date-picker/date-picker.js')) !!}
{!! Html::script(url('mdh/plugins/date-picker/jquery-ui.js')) !!}
{!! Html::script(url('mdh/plugins/input-mask/jquery.maskedinput.js')) !!}

<!--Select2 js -->
{!! Html::script(url('mdh/plugins/select2/select2.full.min.js')) !!}
{!! Html::script(url('mdh/plugins/js/select2.js')) !!}


<!-- File uploads js -->
 <script src="../../assets/plugins/fileupload/js/dropify.js"></script>
<script src="../../assets/js/filupload.js"></script>


</body>
</html>
