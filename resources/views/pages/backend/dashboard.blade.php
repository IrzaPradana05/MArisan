@extends('layouts.backend.index')
@section('title','dashboard')
@section('content')
@push('css')
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/DataTables/extensions/FixedColumns/css/fixedColumns.bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
@endpush
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
					<div class="col-lg-4 col-md-6">
						<div class="widget widget-stats bg-red">
							<div class="stats-icon"><i class="fa fa-desktop"></i></div>
							<div class="stats-info">
								<h4>JUMLAH ARISAN</h4>
								<p>{{$jumlah_arisan}}</p>
							</div>
							<!-- <div class="stats-link">
								<a href="javascript:;">Detail Selengkapnya <i class="fa fa-arrow-alt-circle-right"></i></a>
							</div> -->
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-lg-4 col-md-6">
						<div class="widget widget-stats bg-orange">
							<div class="stats-icon"><i class="fa fa-link"></i></div>
							<div class="stats-info">
								<h4>TOTAL PEMASUKAN</h4>
								<p>{{rupiah($kredit)}}</p>
							</div>
							<!-- <div class="stats-link">
								<a href="javascript:;">Detail Selengkapnya <i class="fa fa-arrow-alt-circle-right"></i></a>
							</div> -->
						</div>
					</div>
					<!-- end col-3 -->
					<!-- begin col-3 -->
					<div class="col-lg-4 col-md-6">
						<div class="widget widget-stats bg-grey-darker">
							<div class="stats-icon"><i class="fa fa-users"></i></div>
							<div class="stats-info">
								<h4>TOTAL PENGELUARAN</h4>
								<p>{{rupiah($debit)}}</p>
							</div>
							<!-- <div class="stats-link">
								<a href="javascript:;">Detail Selengkapnya <i class="fa fa-arrow-alt-circle-right"></i></a>
							</div> -->
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

			<!-- begin row -->
			<div class="row">
				@include('partials.validation')
				<!-- begin col-10 -->
				<div class="col-lg-12">
					<!-- begin panel -->
					<div class="panel panel-inverse">
						<!-- begin panel-heading -->
						<div class="panel-heading">
							<div class="panel-heading-btn">
								<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
							</div>
							<h4 class="panel-title">Daftar Arisan</h4>
						</div>
						<!-- end panel-heading -->

						<!-- begin panel-body -->
						<div class="panel-body">
							<table id="data-table-kamar" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="1%">No</th>
										<th class="text-nowrap">Nama Arisan</th>
										<!-- <th class="text-nowrap">Jumlah Slot</th> -->
										<th class="text-nowrap">Slot Terisi</th>
										<th class="text-nowrap">Iuran Perbulan</th>
										<th class="text-nowrap">Status Arisan</th>
										<th class="text-nowrap">Tanggal</th>
										<th class="text-nowrap">Penulis</th>
										<th class="text-nowrap" data-orderable="false"></th>
									</tr>
								</thead>
								<tbody>
									@php $num=1 @endphp
									@foreach($list_arisan as $data)
										<tr>
											<td>{{$num++}}</td>
											<td>{{$data->nama_arisan}}</td>
											<!-- <td>{{$data->jumlah_slot}}</td> -->
											<td>{{$data->slot_terisi}}/{{$data->jumlah_slot}} Orang</td>
											<td>{{rupiah($data->iuran_perbulan)}}</td>
											<td><span class="{{status_arisan($data->status_arisan)[1]}}"><b>{{status_arisan($data->status_arisan)[0]}}</b></span></td>
											<td>{{format_tanggal($data->created_date,true,false)}}</td>
											<td>{{ucwords($data->pembuat)}}</td>
											<td>
												@if($data->status_arisan == '1' && Auth::user()->role != '0')
													<form action="{{route('join-arisan', $data->id_arisan)}}" method="post">
														@csrf
														@method('post')
														<input type="submit" class="btn btn-info" value="{{in_array(Auth::user()->id, $data->list_id_user) ? 'Joined' : 'Join'}}" {{in_array(Auth::user()->id, $data->list_id_user) ? 'disabled' : ''}}>
													</form>
												@endif
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- end panel-body -->
					</div>
					<!-- end panel -->
				</div>
				<!-- end col-10 -->
			</div>
			<!-- end row -->
			
			
			
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
	<script src="{{asset('assets/plugins/DataTables/media/js/jquery.dataTables.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/FixedColumns/js/dataTables.fixedColumns.min.js')}}"></script>
	<script src="{{asset('assets/js/demo/table-manage-fixed-columns.demo.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Buttons/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Buttons/js/buttons.bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Buttons/js/buttons.flash.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Buttons/js/jszip.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Buttons/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Buttons/js/vfs_fonts.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Buttons/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('assets/plugins/DataTables/extensions/Buttons/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('assets/js/demo/dashboard.min.js')}}"></script>

	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			Dashboard.init();
		});

		$(document).ready(function() {
			$('#data-table-kamar').DataTable({
				dom: 'Bfrtip',
			    buttons: [
			        // 'csv', 'excel', 'pdf', 'print'
			    ]
			});
		});
	</script>
@endpush

