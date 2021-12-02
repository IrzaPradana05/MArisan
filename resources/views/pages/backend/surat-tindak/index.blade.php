@extends('layouts.backend.index')
@section('title','Surat Tindak')
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
				<li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
				<li class="breadcrumb-item active">Surat Tindak Pelanggaran</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Surat Tindak Siswa</h1>
			<!-- end page-header -->
			
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
							<h4 class="panel-title">Rekap Data Pelanggaran</h4>
						</div>
						<!-- end panel-heading -->

						<div class="panel-body">
							<a href="#surat_panggilan" class="btn btn-primary btn-lg" data-toggle="modal">Surat Panggilan</a>
							<a href="#surat_skorsing" class="btn btn-warning btn-lg" data-toggle="modal">Surat Skorsing</a>
							<a href="#surat_dropout" class="btn btn-danger btn-lg" data-toggle="modal">Surat Drop Out</a>
							<!-- #modal-without-animation -->
							<div class="modal" id="surat_panggilan">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Buat Surat Panggilan</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{route('surat-tindak-cetak')}}" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-12">
														<input name="type" type="text" value="panggilan" hidden>
														<label for="nis">NIS <small class="text-danger">*</small></label>
														<select required class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="nis" id="nis">
															<option value="">Pilih Data Siswa</option>
															@foreach($siswa as $data)
																<option value="{{$data->nis}}">{{$data->nis}} - {{ucwords($data->nama)}}</option>
															@endforeach
														</select><br><br>
														<label for="hari">Hari <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="hari" id="hari"><br>
														<label for="tanggal">Tanggal <small class="text-danger">*</small></label>
														<input required type="date" class="form-control" name="tanggal" id="tanggal"><br>
														<label for="jam">Jam <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="jam" id="jam"><br>
														<label for="tempat">Tempat <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="tempat" id="tempat"><br>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" value="Print">
											<input type="reset" class="btn btn-white" value="Reset">
										</div>
											</form>
									</div>
								</div>
							</div>
						<!-- </div> -->

							<div class="modal" id="surat_skorsing">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Buat Surat Skorsing</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form name="update" action="{{route('surat-tindak-cetak')}}" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-12">
														<input name="type" type="text" value="skorsing" hidden>
														<label for="nis">NIS <small class="text-danger">*</small></label>
														<select required class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="nis" id="nis">
															<option value="">Pilih Data Siswa</option>
															@foreach($siswa as $data)
																<option value="{{$data->nis}}">{{$data->nis}} - {{ucwords($data->nama)}}</option>
															@endforeach
														</select><br><br>
														<label for="mulai_tanggal">Mulai Tanggal <small class="text-danger">*</small></label>
														<input required type="date" class="form-control" name="mulai_tanggal" id="mulai_tanggal"><br>
														<label for="sampai_tanggal">Sampai Tanggal <small class="text-danger">*</small></label>
														<input required type="date" class="form-control" name="sampai_tanggal" id="sampai_tanggal"><br>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" value="Print">
											<input type="reset" class="btn btn-white" value="Reset">
										</div>
											</form>
									</div>
								</div>
							</div>

							<div class="modal" id="surat_dropout">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Buat Surat Drop Out</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form name="update" action="{{route('surat-tindak-cetak')}}" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-12">
														<input name="type" type="text" value="dropout" hidden>
														<label for="nis">NIS <small class="text-danger">*</small></label>
														<select required class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="nis" id="nis">
															<option value="">Pilih Data Siswa</option>
															@foreach($siswa as $data)
																<option value="{{$data->nis}}">{{$data->nis}} - {{ucwords($data->nama)}}</option>
															@endforeach
														</select><br><br>
														<label for="tanggal">Tanggal Drop Out <small class="text-danger">*</small></label>
														<input required type="date" class="form-control" name="tanggal" id="tanggal"><br>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" value="Print">
											<input type="reset" class="btn btn-white" value="Reset">
										</div>
											</form>
									</div>
								</div>
							</div>

						</div>

						<!-- begin panel-body -->
						<div class="panel-body">
							<table id="data-table-kamar" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th width="1%">No</th>
										<th class="text-nowrap">NIS</th>
										<th class="text-nowrap">Nama</th>
										<th class="text-nowrap">Kelas</th>
										<th class="text-nowrap">Jenis Kelamin</th>
										<th class="text-nowrap">Total Poin Pelanggaran</th>
									</tr>
								</thead>
								<tbody>
									@php $num=1 @endphp
									@foreach($siswa as $data)
										<tr>
											<td>{{$num++}}</td>
											<td>{{$data->nis}}</td>
											<td>{{ucwords($data->nama)}}</td>
											<td>{{$data->nama_kelas}}</td>
											<td>{{$data->jk == 'L' ? 'Laki-laki' : ($data->jk == 'P' ? 'Perempuan' : '')}}</td>
											<td>{{$data->total_poin}}</td>
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
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			$('#data-table-kamar').DataTable({
				dom: 'Bfrtip',
			    buttons: [
			        'csv', 'excel', 'pdf', 'print'
			    ]
			});
		});

		function isNumber(evt) {
		    evt = (evt) ? evt : window.event;
		    var charCode = (evt.which) ? evt.which : evt.keyCode;
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		        return false;
		    }
		    return true;
		}

		//Tampilkan form modal edit
		// $('.edit_data').click(function (){
		// 	var url_update = $(this).attr('url-update');
		// 	ajaxSetup;
		// 	$.ajax({
		// 	  url: $(this).attr('url'),
		// 	  type:"GET",
		// 	  success:function(response){
		// 	    $('form[name=update]').attr('action', url_update)
		// 	    $('input[name=nama_edit]').val(response['nama'])
		// 	    $('select[name=kode_kelas_edit]').val(response['kode_kelas'])
		// 	    $('input[name=tanggal_lahir_edit]').val(response['tanggal_lahir'])
		// 	    $('select[name=jk_edit]').val(response['jk'])
		// 	    $('select[name=ktp_edit]').val(response['no_ktp_wali'])
		// 	    $('#edit_form').modal().show()
		// 	  },
		// 	});
		// });
	</script>

@endpush

