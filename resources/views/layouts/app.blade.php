<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="MDH - ERP" name="description">
    <meta content="Management For Development and Health" name="author">
    <meta name="keywords" content="Mimosa"/>
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

    @stack('after-styles')
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

@stack('before-scripts')

<script>
    var base_url = "{!! url("/") !!}";
</script>
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
{{--{!! Html::script(url('mdh/plugins/p-scrollbar/p-scroll1.js')) !!}--}}

<!--Select2 js -->
{!! Html::script(url('mdh/plugins/select2/select2.full.min.js')) !!}
{!! Html::script(url('mdh/js/select2.js')) !!}

<!-- Timepicker js -->
{{--<script src="mdh/plugins/time-picker/jquery.timepicker.js"></script>--}}
{{--<script src="mdh/plugins/time-picker/toggles.min.js"></script>--}}

<!-- Datepicker js -->
{{--{!! Html::script(url('mdh/plugins/date-picker/date-picker.js')) !!}--}}
{{--{!! Html::script(url('mdh/plugins/date-picker/jquery-ui.js')) !!}--}}
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
{{--<script src="mdh/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js"></script>--}}
{{--<script src="mdh/js/form-wizard.js"></script>--}}

@stack('in-scripts')
<!-- AdminLTE App -->
{{--{!! Html::script(url('dist/js/adminlte.min.js')) !!}--}}

{{--{!! Html::script(url('plugins/summernote/summernote-bs4.min.js')) !!}--}}

{!! Html::script(url('plugins/maskmoney/jquery.maskMoney.js')) !!}
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
    })
</script>

@stack('after-scripts')



</body>

</html>
