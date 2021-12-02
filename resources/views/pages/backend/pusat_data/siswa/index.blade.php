@extends('layouts.backend.index')
@section('title','Siswa')
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
				<li class="breadcrumb-item"><a href="javascript:;">Pusat Data</a></li>
				<li class="breadcrumb-item active">Siswa</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Data Siswa</h1>
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
							<h4 class="panel-title">Data Master Siswa</h4>
						</div>
						<!-- end panel-heading -->

						<div class="panel-body">
							<a href="#add_data" class="btn btn-primary btn-lg" data-toggle="modal">Tambah Data</a>
							<!-- #modal-without-animation -->
							<div class="modal" id="add_data">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Tambah Siswa</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{route('siswa-create')}}" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-6">
														<label for="nis">NIS <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="nis" id="nis" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><br>
														<label for="nama">Nama Lengkap <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="nama" id="nama"><br>
														<label for="email">E-mail <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="email" id="email"><br>
														<label for="kelas">Kelas <small class="text-danger">*</small></label>
														<select required type="text" class="form-control" name="kode_kelas" id="kode_kelas">
															<option value="">-- Pilih Kelas --</option>
															@foreach($kelas as $data)
																<option value="{{$data->kode_kelas}}">{{$data->nama_kelas}}</option>
															@endforeach
														</select><br>
													</div>
													<div class="col-md-6">
														<label for="tanggal_lahir">Tanggal Lahir <small class="text-danger">*</small></label>
														<input required type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"><br>
														<label for="jk">Jenis Kelamin <small class="text-danger">*</small></label>
														<select required type="text" class="form-control" name="jk" id="jk">
															<option value="L">Laki-laki</option>
															<option value="P">Perempuan</option>
														</select><br>
														<label for="ktp">No. KTP Wali <small class="text-danger">*</small></label>
														<!-- <input required type="text" class="form-control" name="ktp" id="ktp" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><br> -->
														<select required class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="ktp" id="ktp">
															<option value="">Pilih Data Wali</option>
															@foreach($wali as $data)
																<option value="{{$data->no_ktp}}">{{$data->no_ktp}} - {{ucwords($data->nama)}}</option>
															@endforeach
														</select>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" value="+Tambah">
											<input type="reset" class="btn btn-white" value="Reset">
										</div>
											</form>
									</div>
								</div>
							</div>
						<!-- </div> -->

							<div class="modal" id="edit_form">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Edit Data Siswa</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form name="update" action="" method="post">
												@csrf
												@method('put')
												<div class="row">
													<div class="col-md-6">
														<label for="nama_edit">Nama Lengkap <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="nama_edit" id="nama_edit"><br>
														<label for="kode_kelas_edit">Kelas <small class="text-danger">*</small></label>
														<select required type="text" class="form-control" name="kode_kelas_edit" id="kode_kelas_edit">
															<option value="">-- Pilih Kelas --</option>
															@foreach($kelas as $data)
																<option value="{{$data->kode_kelas}}">{{$data->nama_kelas}}</option>
															@endforeach
														</select><br>
														<label for="tanggal_lahir_edit">Tanggal Lahir <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="tanggal_lahir_edit" id="tanggal_lahir_edit"><br>
													</div>
													<div class="col-md-6">
														<label for="jk_edit">Jenis Kelamin <small class="text-danger">*</small></label>
														<select required type="text" class="form-control" name="jk_edit" id="jk_edit">
															<option value="L">Laki-laki</option>
															<option value="P">Perempuan</option>
														</select><br>
														<label for="ktp_edit">No. KTP Wali <small class="text-danger">*</small></label>
														<!-- <input required type="text" class="form-control" name="ktp_edit" id="ktp_edit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><br> -->
														<select required class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="ktp_edit" id="ktp_edit">
															<option value="">Pilih Data Wali</option>
															@foreach($wali as $data)
																<option value="{{$data->no_ktp}}">{{$data->no_ktp}} - {{ucwords($data->nama)}}</option>
															@endforeach
														</select>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" value="Update">
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
										<th class="text-nowrap">Tgl. Lahir</th>
										<th class="text-nowrap">Jenis Kelamin</th>
										<th class="text-nowrap">Nama Wali</th>
										<th class="text-nowrap" data-orderable="false">Aksi</th>
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
											<td>{{$data->tanggal_lahir}}</td>
											<td>{{$data->jk == 'L' ? 'Laki-laki' : ($data->jk == 'P' ? 'Perempuan' : '')}}</td>
											<td>{{ucwords($data->nama_wali)}}</td>
											<td>
												<a href="javascript:;" url="{{route('siswa-ajax-edit', $data->nis)}}" class="edit_data" url-update="{{route('siswa-update', $data->nis)}}"><i class="fas fa-lg fa-fw m-r-10 fa-edit text-warning"></i></a>
												<a href="{{route('siswa-delete', $data->nis)}}"><i class="fas fa-lg fa-fw m-r-10 fa-trash text-danger"></i></a>
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
		$('.edit_data').click(function (){
			var url_update = $(this).attr('url-update');
			ajaxSetup;
			$.ajax({
			  url: $(this).attr('url'),
			  type:"GET",
			  success:function(response){
			    $('form[name=update]').attr('action', url_update)
			    $('input[name=nama_edit]').val(response['nama'])
			    $('select[name=kode_kelas_edit]').val(response['kode_kelas'])
			    $('input[name=tanggal_lahir_edit]').val(response['tanggal_lahir'])
			    $('select[name=jk_edit]').val(response['jk'])
			    $('select[name=ktp_edit]').val(response['no_ktp_wali'])
			    $('#edit_form').modal().show()
			  },
			});
		});
	</script>

@endpush

