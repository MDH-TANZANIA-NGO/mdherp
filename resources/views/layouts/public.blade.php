
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

    <!-- Meta data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta content="Clont - Bootstrap Webapp Responsive Dashboard Simple Admin Panel Premium HTML5 Template" name="description">
    <meta content="Spruko Technologies Private Limited" name="author">
    <meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/>

    <!-- Title -->
    <title>{{ config("app.name") }}</title>

    <!-- Style css -->
{{ Html::style(url('mdh/css/style.css')) }}

<!---Icons css-->
    {{ Html::style(url('mdh/plugins/web-fonts/icons.css')) }}
    {{ Html::style(url('mdh/plugins/web-fonts/font-awesome/font-awesome.min.css')) }}
    {{ Html::style(url('mdh/plugins/web-fonts/plugin.css')) }}

</head>

<body class="app sidebar-mini" style="background-color: #f5f5f5">
<div class="row">
    <div class="col mx-auto">
        <div class="app-header header top-header comb-header">
            <div class="container-fluid">
                <div class="d-flex">
                    <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a><!-- sidebar-toggle-->
                    <a class="header-brand" href="http://mdh_erp.test/workspace">
                        <img src="../../mdh/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="MDH logo">
                        <img src="../../mdh/images/brand/logo.png" class="header-brand-img dark-logo" alt="MDH logo">
                        <img src="../../mdh/images/brand/logo.png" class="header-brand-img mobile-logo" alt="MDH logo">
                        <img src="../../mdh/images/brand/logo.png" class="header-brand-img darkmobile-logo" alt="MDH logo">
                    </a>


                    <div class="d-flex order-lg-2 ml-auto">
                        <a href="#" data-toggle="search" class="nav-link nav-link-lg d-md-none navsearch"><i class="fa fa-search"></i></a>
                        <div class="mt-1">
                            <form class="form-inline">
                                <div class="search-element">
                                    <input type="search" class="form-control header-search" placeholder="Search…" aria-label="Search" tabindex="1">
                                    <button class="btn btn-primary-color" type="submit"><i class="fa fa-search text-dark"></i></button>
                                </div>
                            </form>
                        </div><!-- SEARCH -->




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-8">
    <div class="page-single">

        <div class="container">
            <div class="side-app mt-20">
                @yield('content')
            </div>
        </div>
    </div>
</div>

</body>
</html>

