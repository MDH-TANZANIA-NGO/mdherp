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

    <!--Favicon -->
    <link rel="icon" href="mdh/images/brand/favicon.ico" type="image/x-icon"/>

    <!-- Style css -->
{{ Html::style(url('mdh/css/style.css')) }}

<!---Icons css-->
    {{ Html::style(url('mdh/plugins/web-fonts/icons.css')) }}
    {{ Html::style(url('mdh/plugins/web-fonts/font-awesome/font-awesome.min.css')) }}
    {{ Html::style(url('mdh/plugins/web-fonts/plugin.css')) }}

</head>

<body class="h-100vh">
<div class="page comb-page">
    <div class="page-single">
        <div class="container">
            <div class="row">
                <div class="col mx-auto">
                    <div class="text-center mb-6">
                        <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img desktop-lgo" alt="MDH">
                        <img src="{{ asset('mdh/images/brand/logo.png') }}" class="header-brand-img dark-logo" alt="Clont logo">
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card-group mb-0">
                                <div class="card p-6">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="card-body">
                                            <h1>Login</h1>
                                            <p class="text-muted">Sign In to your account</p>
                                            <div class="input-group mb-3">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-4">
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                                                </div>
                                                <div class="col-12">
                                                    <a href="forgot-password.html" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                {{--                                <div class="card text-white bg-primary py-5 d-md-down-none ">--}}
                                {{--                                    <div class="card-body text-center justify-content-center ">--}}
                                {{--                                        <h2>Sign up</h2>--}}
                                {{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.ed ut perspiciatis unde omnis iste natus error sit voluptatem  </p>--}}
                                {{--                                        <a href="register.html" class="btn btn-secondary mt-3">Register Now!</a>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
