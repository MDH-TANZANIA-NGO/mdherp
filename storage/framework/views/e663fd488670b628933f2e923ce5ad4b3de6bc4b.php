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
		<title><?php echo e(config("app.name")); ?></title>

	    <!-- Style css -->
<?php echo e(Html::style(url('mdh/css/style.css'))); ?>


<!---Icons css-->
    <?php echo e(Html::style(url('mdh/plugins/web-fonts/icons.css'))); ?>

    <?php echo e(Html::style(url('mdh/plugins/web-fonts/font-awesome/font-awesome.min.css'))); ?>

    <?php echo e(Html::style(url('mdh/plugins/web-fonts/plugin.css'))); ?>


	</head>

	<body class="h-100vh">
		<div class="page comb-page">
			<div class="page-single">
				<div class="container">
					<div class="row">
						<div class="col mx-auto">
							<div class="text-center mb-6">
								<img src="../../mdh/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="Clont logo">
								<!-- <img src="../../mdh/images/brand/logo1.png" class="header-brand-img dark-logo" alt="Clont logo"> -->
							</div>
							<div class="row justify-content-center">
								<div class="col-md-8">
									<div class="card-group mb-0">
										<div class="card p-4">
											<div class="card-body">
                                            <form method="POST" action="<?php echo e(route('login')); ?>">
                                            <?php echo csrf_field(); ?>
												<h1>Login</h1>
												<p class="text-muted">Sign In to your account</p>

												<div class="input-group mb-3">
													<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" placeholder="Email" autofocus>

                                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

												</div>
												<div class="input-group mb-4">
													<span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" placeholder="Password">

                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($message); ?></strong>
                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

												</div>
												<div class="row">
													<div class="col-12">
														<button type="submit" class="btn btn-primary btn-block"><?php echo e(__('Login')); ?></button>
													</div>
													<div class="col-12">
														<a href="forgot-password.html" class="btn btn-link box-shadow-0 px-0">Forgot password?</a>
													</div>
                                                    <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                                    <label class="form-check-label" for="remember">
                                                        <?php echo e(__('Remember Me')); ?>

                                                    </label>
                                                </div>
                            </div>
												</div>
											</div>
                                            </form>
										</div>

										<!-- <div class="card text-white  py-5 d-md-down-none " style="background-color:white;"> -->
										<div class="card text-white  py-6 d-md-down-none " >
											<div class="card-body text-center justify-content-center " style="margin-top:10%">

                                            <!-- <img src="../../mdh/images/photos/home2.png" > -->
                                            <img src="../../mdh/images/photos/home.png" >

												<!-- <a href="register.html" class="btn btn-secondary mt-3">Register Now!</a> -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Jquery js-->
		<script src="../../mdh/js/vendors/jquery-3.4.0.min.js"></script>

		<!-- Bootstrap4 js-->
		<script src="../../mdh/plugins/bootstrap/popper.min.js"></script>
		<script src="../../mdh/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Othercharts js-->
		<script src="../../mdh/plugins/othercharts/jquery.sparkline.min.js"></script>

		<!-- Circle-progress js-->
		<script src="../../mdh/js/vendors/circle-progress.min.js"></script>

		<!-- Jquery-rating js-->
		<script src="../../mdh/plugins/rating/jquery.rating-stars.js"></script>

	</body>
</html>
<?php /**PATH /Users/elinipendomziray/Sites/mdherp/resources/views/welcomepage.blade.php ENDPATH**/ ?>