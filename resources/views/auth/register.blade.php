<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>M-Arisan | Register</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/animate/animate.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/apple/style.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/apple/style-responsive.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/css/apple/theme/default.css')}}" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->

	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
	<!-- ================== END PAGE LEVEL STYLE ================== -->
</head>
<body class="pace-top bg-white">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin register -->
		<div class="register register-with-news-feed">
			<!-- begin news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url({{asset('assets/img/login-bg/arisan.png')}})"></div>
				<div class="news-caption">
					<h4 class="caption-title"><b>Main</b> Arisan</h4>
					<p>
						SELAMAT DATANG DI SISTEM INFORMASI ARISAN 2021.
					</p>
				</div>
			</div>
			<!-- end news-feed -->
			<!-- begin right-content -->
			<div class="right-content">
				<!-- begin register-header -->
				<h1 class="register-header">
					Sign Up
					<small>Silahkan Mendaftar untuk Membuat akun baru agar bisa login pada Sistem Main Arisan 2021.</small>
				</h1>
				<!-- end register-header -->
				<!-- begin register-content -->
				<div class="register-content">
					<form action="{{ route('register') }}" method="POST" class="margin-bottom-0">
						@csrf
						<label class="control-label">Username <span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-12 m-b-15">
								<input name="username" type="text" class="form-control" placeholder="First name" required />
							</div>
						</div>
						<!-- <label class="control-label">Email <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input name="email" type="text" class="form-control" placeholder="Email address" required />
							</div>
						</div> -->
						<label class="control-label">Password <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input name="password" type="password" class="form-control" placeholder="Password" required />
							</div>
						</div>

						<label class="control-label">Confirm Password<span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required />
							</div>
						</div>

						<div class="form-group">
                        <label for="role">Role<span class="text-danger">*</span></label>
                          <select id="role" class="form-control custom-select" id="role" name="role" required >
                            <option selected disabled> --Pilih Jenis Role-- </option>
                            <option value="1">Panitia</option>
                            <option value="2">Anggota</option>
                          </select>
                      </div>


						<!-- <div class="checkbox checkbox-css m-b-30">
							<div class="checkbox checkbox-css m-b-30">
								<input type="checkbox" id="agreement_checkbox" value="" required>
								<label for="agreement_checkbox">
								By clicking Sign Up, you agree to our <a href="javascript:;">Terms</a> and that you have read our <a href="javascript:;">Data Policy</a>, including our <a href="javascript:;">Cookie Use</a>.
								</label>
							</div>
						</div> -->

						<div class="register-buttons">
							<button type="submit" class="btn btn-primary btn-block btn-lg">Sign Up</button>
						</div>
						<div class="m-t-20 m-b-40 p-b-40 text-inverse">
							Kembali Ke Halaman <a href="{{route('login')}}"> LOGIN </a>
						</div>
						<hr />
						<p class="text-center">
							&copy; Sistem Arisan All Right Reserved 2021
						</p>
					</form>
				</div>
				<!-- end register-content -->
			</div>
			<!-- end right-content -->
		</div>
		<!-- end register -->
		
		<!-- begin theme-panel -->
		<div class="theme-panel theme-panel-lg">
			<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="ion-ios-cog"></i></a>
			<div class="theme-panel-content">
				<h5 class="m-t-0">Color Theme</h5>
				<ul class="theme-list clearfix">
					<li><a href="javascript:;" class="bg-red" data-theme="red" data-theme-file="../assets/css/apple/theme/red.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-pink" data-theme="pink" data-theme-file="../assets/css/apple/theme/pink.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Pink">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-orange" data-theme="orange" data-theme-file="../assets/css/apple/theme/orange.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-yellow" data-theme="yellow" data-theme-file="../assets/css/apple/theme/yellow.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Yellow">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-lime" data-theme="lime" data-theme-file="../assets/css/apple/theme/lime.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Lime">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-green" data-theme="green" data-theme-file="../assets/css/apple/theme/green.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Green">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-teal" data-theme="teal" data-theme-file="../assets/css/apple/theme/teal.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Teal">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-aqua" data-theme="aqua" data-theme-file="../assets/css/apple/theme/aqua.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Aqua">&nbsp;</a></li>
					<li class="active"><a href="javascript:;" class="bg-blue" data-theme="default" data-theme-file="../assets/css/apple/theme/default.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-purple" data-theme="purple" data-theme-file="../assets/css/apple/theme/purple.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-indigo" data-theme="indigo" data-theme-file="../assets/css/apple/theme/indigo.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Indigo">&nbsp;</a></li>
					<li><a href="javascript:;" class="bg-black" data-theme="black" data-theme-file="../assets/css/apple/theme/black.css" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
				</ul>
				<div class="divider"></div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Header Styling</div>
					<div class="col-md-6">
						<select name="header-styling" class="form-control form-control-sm">
							<option value="1">default</option>
							<option value="2">inverse</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Header</div>
					<div class="col-md-6">
						<select name="header-fixed" class="form-control form-control-sm">
							<option value="1">fixed</option>
							<option value="2">default</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Sidebar Styling</div>
					<div class="col-md-6">
						<select name="sidebar-styling" class="form-control form-control-sm">
							<option value="1">default</option>
							<option value="2">grid</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Sidebar</div>
					<div class="col-md-6">
						<select name="sidebar-fixed" class="form-control form-control-sm">
							<option value="1">fixed</option>
							<option value="2">default</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Sidebar Gradient</div>
					<div class="col-md-6">
						<select name="content-gradient" class="form-control form-control-sm">
							<option value="1">disabled</option>
							<option value="2">enabled</option>
						</select>
					</div>
				</div>
				<div class="row m-t-10">
					<div class="col-md-6 control-label text-inverse f-w-600">Direction</div>
					<div class="col-md-6">
						<select name="direction" class="form-control form-control-sm">
							<option value="1">LTR</option>
							<option value="2">RTL</option>
						</select>
					</div>
				</div>
				<div class="divider"></div>
				<h5>THEME VERSION</h5>
				<div class="theme-version">
					<a href="../template_html/index_v2.html">
						<span style="background-image: url(../assets/img/theme/default.jpg);"></span>
					</a>
					<a href="../template_transparent/index_v2.html">
						<span style="background-image: url(../assets/img/theme/transparent.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="../template_apple/index_v2.html" class="active">
						<span style="background-image: url(../assets/img/theme/apple.jpg);"></span>
					</a>
					<a href="../template_material/index_v2.html">
						<span style="background-image: url(../assets/img/theme/material.jpg);"></span>
					</a>
				</div>
				<div class="theme-version">
					<a href="../template_facebook/index_v2.html">
						<span style="background-image: url(../assets/img/theme/facebook.jpg);"></span>
					</a>
				</div>
				<div class="divider"></div>
				<div class="row m-t-10">
					<div class="col-md-12">
						<a href="javascript:;" class="btn btn-inverse btn-block btn-rounded" data-click="reset-local-storage"><b>Reset Local Storage</b></a>
					</div>
				</div>
			</div>
		</div>
		<!-- end theme-panel -->
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{asset('assets/plugins/jquery/jquery-3.3.1.min.js')}}"></script>
	<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	<!--[if lt IE 9]-->
	<!--<script src="{{asset('assets/crossbrowserjs/html5shiv.js')}}"></script>-->
	<!--<script src="{{asset('assets/crossbrowserjs/respond.min.js')}}"></script>-->
	<!--<script src="{{asset('assets/crossbrowserjs/excanvas.min.js')}}"></script>-->
	<!-- <![endif]-->
	<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
	<script src="{{asset('assets/js/theme/apple.min.js')}}"></script>
	<script src="{{asset('assets/js/apps.min.js')}}"></script>
	<!-- ================== END BASE JS ================== -->
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>
</html>
