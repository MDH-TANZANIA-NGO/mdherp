<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>

    <!-- Title -->
    <title>@stack('title')</title>

    <!--Favicon -->
{{--    <link rel="icon" href="../../assets/images/brand/favicon.ico" type="image/x-icon"/>--}}

    <!-- Style css -->
    {{ Html::style(url('mdh/css/style.css')) }}

    <!---Icons css-->
    {{ Html::style(url('mdh/plugins/web-fonts/icons.css')) }}
    {{ Html::style(url('mdh/plugins/web-fonts/font-awesome/font-awesome.min.css')) }}
    {{ Html::style(url('mdh/plugins/web-fonts/plugin.css')) }}

</head>
<body class="h-100vh">

@yield('content')

<!-- Jquery js-->
{!! Html::script(url('mdh/js/vendors/jquery-3.4.0.min.js')) !!}

<!-- Bootstrap4 js-->
{!! Html::script(url('mdh/js/vendors/popper.min.js')) !!}
{!! Html::script(url('mdh/js/vendors/bootstrap.min.js')) !!}

</body>
</html>
