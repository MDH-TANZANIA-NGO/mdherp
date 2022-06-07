<!DOCTYPE html>
<html lang="en">

<head>

	<!-- Meta data -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta content="Clont - Bootstrap Webapp Responsive Dashboard Simple Admin Panel Premium HTML5 Template" name="description">
	<meta content="Spruko Technologies Private Limited" name="author">
	<meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template" />

	<!-- Title -->
	<title>MDH</title>

	<!--Favicon -->
	<link rel="icon" href="../../mdh/images/brand/logo.png" type="image/x-icon" />

	<!-- Style css -->
	<link href="../../assets/css/style.css" rel="stylesheet" />


	<!-- sweetalert -->

	<link href="node_modules/sweetalert2/dist/sweetalert2.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


	<!-- Data table css -->
	<link href="../../assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

	<link href="//cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet" />

	<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
	<link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />


	<!-- Time -->

	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />




	<!--Horizontal css -->
	<link id="effect" href="../../assets/plugins/horizontal-menu/dropdown-effects/fade-up.css" rel="stylesheet" />
	<link href="../../assets/plugins/horizontal-menu/horizontal.css" rel="stylesheet" />

	<!--Sidemenu css -->
	<link href="../../assets/plugins/sidemenu/combine-menu/combine-menu.css" rel="stylesheet">

	<!-- P-scroll bar css-->
	<link href="../../assets/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

	<!---Icons css-->
	<link href="../../assets/plugins/web-fonts/icons.css" rel="stylesheet" />
	<link href="../../assets/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
	<link href="../../assets/plugins/web-fonts/plugin.css" rel="stylesheet" />

	<!-- Skin css-->
	<link href="../../assets/css/skins.css" rel="stylesheet" />





















	<!-- Favicon -->

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="{{ URL::to('asset/css/bootstrap.min.css') }}">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('asset/css/font-awesome.min.css') }}">
	<!-- Lineawesome CSS -->
	<link rel="stylesheet" href="{{ URL::to('asset/css/line-awesome.min.css') }}">
	<!-- Datatable CSS -->
	<link rel="stylesheet" href="{{ URL::to('asset/css/dataTables.bootstrap4.min.css') }}">
	<!-- Select2 CSS -->
	<link rel="stylesheet" href="{{ URL::to('asset/css/select2.min.css') }}">
	<!-- Datetimepicker CSS -->
	<link rel="stylesheet" href="{{ URL::to('asset/css/bootstrap-datetimepicker.min.css') }}">
	<!-- Chart CSS -->
	<link rel="stylesheet" href="{{ URL::to('sset/plugins/morris/morris.css') }}">
	<!-- Main CSS -->
	<link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ URL::to('asset/css/style.css') }}">

	{{-- message toastr --}}
	<link rel="stylesheet" href="{{ URL::to('asset/css/toastr.min.css') }}">
	<script src="{{ URL::to('asset/js/toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('asset/js/toastr.min.js') }}"></script>
</head>

<body class="app sidebar-mini">

	<!---Global-loader-->
	<div id="global-loader">
		<img src="../../assets/images/svgs/loader.svg" alt="loader">
	</div>

	<div class="page comb-page">
		<div class="page-main">
			<div class="app-header header top-header comb-header">
				<div class="container-fluid">
					<div class="d-flex">
						<a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a><!-- sidebar-toggle-->
						<a class="header-brand" href="index.html">
							<img src="../../mdh/images/brand/logo.png" class="header-brand-img desktop-lgo" alt="Clont logo">

						</a>
						<div class="dropdown   side-nav">
							<a aria-label="Hide Sidebar" class="app-sidebar__toggle nav-link icon mt-1" data-toggle="sidebar" href="#">
								<i class="fe fe-align-left"></i>
							</a><!-- sidebar-toggle-->
						</div>
						

						
							</div>
						</div>
					</div>
				</div>
			</div>



			

		</div>



	</div>




	<style>
		.invalid-feedback {
			font-size: 14px;
		}
	</style>
	<!-- Main Wrapper -->
	<div class="main-wrapper">


		@yield('content')

	</div>
	<!-- /Main Wrapper -->

	<!-- jQuery -->

	<!-- Datetimepicker JS -->
	<script src="{{ URL::to('asset/js/moment.min.js') }}"></script>
	<script src="{{ URL::to('asset/js/bootstrap-datetimepicker.min.js') }}"></script>
	<!-- Datatable JS -->
	<script src="{{ URL::to('asset/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ URL::to('asset/js/dataTables.bootstrap4.min.js') }}"></script>
	<!-- Multiselect JS -->
	<script src="{{ URL::to('asset/js/multiselect.min.js') }}"></script>
	<!-- Custom JS -->
	<script src="{{ URL::to('asset/js/app.js') }}"></script>

	@yield('script')












	<!-- Back to top -->
	<a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>

	<!-- Jquery js-->
	<script src="../../assets/js/vendors/jquery-3.4.0.min.js"></script>

	<!-- Bootstrap4 js-->
	<script src="../../assets/plugins/bootstrap/popper.min.js"></script>
	<script src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!--Othercharts js-->
	<script src="../../assets/plugins/othercharts/jquery.sparkline.min.js"></script>

	<!-- Circle-progress js-->
	<script src="../../assets/js/vendors/circle-progress.min.js"></script>

	<!-- Jquery-rating js-->
	<script src="../../assets/plugins/rating/jquery.rating-stars.js"></script>

	<!--Horizontal js-->
	<script src="../../assets/plugins/horizontal-menu/horizontal.js"></script>

	<!--Sidemenu js-->
	<script src="../../assets/plugins/sidemenu/combine-menu/combine-menu.js"></script>

	<!-- P-scroll js-->
	<script src="../../assets/plugins/p-scrollbar/p-scrollbar.js"></script>
	<script src="../../assets/plugins/p-scrollbar/p-scroll1.js"></script>
	<script src="../../assets/plugins/p-scrollbar/p-scroll1.js"></script>

	<!-- Custom js-->
	<script src="../../assets/js/custom.js"></script>

	<!-- Time -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css"></script>

	<!-- Data tables js-->
	<script src=" ../../assets/plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="../../assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
	<script src="../../assets/js/datatables.js"></script>
	<script src=" //cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>





	<script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
	<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>

	<script src="{{URL::to('assets/js/front.js')}}"></script>


	<script>
		$(document).ready(function() {
			$('#one').DataTable();
		});
	</script>
	
	@yield('scripts')

</body>

</html>