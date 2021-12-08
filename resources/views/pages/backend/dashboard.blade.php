@extends('layouts.backend.index')
@section('title','dashboard')
@section('content')
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		@include('includes.backend.menu-nav')
		@include('includes.backend.sidebar')
		
		<!-- begin #content -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb pull-right">
				<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Selamat Datang!</h1>
			<!-- end page-header -->
			
			@roleCanAccess(['0'])
				<!-- begin row -->
				<div class="row">
					<!-- begin col-3 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget widget-stats bg-red">
							<div class="stats-icon"><i class="fa fa-desktop"></i></div>
							<div class="stats-info">
								<h4>TOTAL POIN PELANGGARAN</h4>
								<p>{{$poin_pelanggaran}}</p>
							</div>
							<div class="stats-link">
								<a href="{{route('pelanggaran-index')}}">Detail Selengkapnya <i class="fa fa-arrow-alt-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget widget-stats bg-orange">
							<div class="stats-icon"><i class="fa fa-link"></i></div>
							<div class="stats-info">
								<h4>TOTAL PRESTASI</h4>
								<p>{{$prestasi}}</p>
							</div>
							<div class="stats-link">
								<a href="{{route('prestasi-index')}}">Detail Selengkapnya <i class="fa fa-arrow-alt-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget widget-stats bg-grey-darker">
							<div class="stats-icon"><i class="fa fa-users"></i></div>
							<div class="stats-info">
								<h4>BIMBINGAN KONSELING</h4>
								<p>{{$konseling}}</p>
							</div>
							<div class="stats-link">
								<a href="{{route('konseling-index')}}">Detail Selengkapnya <i class="fa fa-arrow-alt-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-lg-3 col-md-6">
						<div class="widget widget-stats bg-black-lighter">
							<div class="stats-icon"><i class="fa fa-clock"></i></div>
							<div class="stats-info">
								<h4>BIMBINGAN KARIR</h4>
								<p>{{$karir}}</p>
							</div>
							<div class="stats-link">
								<a href="{{route('karir-index')}}">Detail Selengkapnya <i class="fa fa-arrow-alt-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- end col-3 -->
				</div>
				<!-- end row -->
			@endroleCanAccess

			<!-- with right icon -->
			<!-- <div class="note note-info note-with-left-icon">
			  <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
			  <div class="note-content text-left">
			    <h4><b>Apa itu Konseling ?</b></h4>
			    <p>Konseling adalah hubungan pribadi yang dilakukan secara tatap muka antarab dua orang dalam mana konselor melalui hubungan itu dengan kemampuan-kemampuan khusus yang dimilikinya, menyediakan situasi belajar. Dalam hal ini konseli dibantu untuk memahami diri sendiri, keadaannya sekarang, dan kemungkinan keadaannya masa depan yang dapat ia ciptakan dengan menggunakan potensi yang dimilikinya, demi untuk kesejahteraan pribadi maupun masyarakat. Lebih lanjut konseling dapat belajar bagaimana memecahkan masalah-masalah dan menemukan kebutuhan-kebutuhan yang akan datang. (Tolbert, dalam Prayitno 2004 : 101).</p>
			  </div>
			</div> -->
			
			
			
		</div>
		<!-- end #content -->
		
@include('includes.backend.theme-panel')

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
@endsection
@push('js')
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
	<script src="{{asset('assets/plugins/flot/jquery.flot.min.js')}}"></script>
	<script src="{{asset('assets/plugins/flot/jquery.flot.time.min.js')}}"></script>
	<script src="{{asset('assets/plugins/flot/jquery.flot.resize.min.js')}}"></script>
	<script src="{{asset('assets/plugins/flot/jquery.flot.pie.min.js')}}"></script>
	<script src="{{asset('assets/plugins/sparkline/jquery.sparkline.js')}}"></script>
	<script src="{{asset('assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{asset('assets/js/demo/dashboard.min.js')}}"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			Dashboard.init();
		});
	</script>
@endpush

