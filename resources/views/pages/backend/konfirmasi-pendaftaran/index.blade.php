@extends('layouts.backend.index')
@section('title','Arisan')
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
				<li class="breadcrumb-item active">Konfirmasi Pendaftaran</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Konfirmasi Pendaftaran</h1>
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
							<h4 class="panel-title">Data Pendaftar Baru</h4>
						</div>
						<!-- end panel-heading -->

						<div class="panel-body">
							
							<div class="modal" id="edit_form">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Detail Data</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form name="update" action="" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-12">
														<label for="name">Nama Lengkap</label>
														<input required type="text" class="form-control" name="name" id="name" value="" disabled><br>
														<label for="no_hp">No HP</label>
														<input required type="text" class="form-control" name="no_hp" id="no_hp" value="" disabled><br>
														<label for="nik">NIK</label>
														<input required type="text" class="form-control" name="nik" id="nik" value="" disabled><br>
														
														<label for="tempat_lahir">Temp. Lahir</label>
														<input required type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="" disabled><br>
														<label for="tanggal_lahir">Tgl. Lahir</label>
														<input required type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="" disabled><br>
														<label for="tipe_wallet">Tipe Wallet</label>
														<input required type="text" class="form-control" name="tipe_wallet" id="tanggal_lahir" value="" disabled><br>
														<label for="no_wallet">No. Wallet</label>
														<input required type="text" class="form-control" name="no_wallet" id="tanggal_lahir" value="" disabled><br>
														<label for="alamat">Alamat</label>
														<textarea required type="text" class="form-control" name="alamat" id="alamat" disabled></textarea><br>
														<label for="surat_komitmen">Surat Komitmen</label><br>
														<img class="media-object" name="surat" src="" alt="" style="max-width: 600px;"><br><br>
														<label for="status_aktif">Status Data</label>
														<select required class="form-control" name="status_aktif" id="status_aktif">
															<option value="">-- Pilih Status --</option>
															<option value="1">Valid</option>
															<option value="2">Tidak Valid</option>
														</select><br>
													</div>
												</div>
										</div>
										<div class="modal-footer">
											<input type="submit" class="btn btn-success" value="SUBMIT">
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
										<th class="text-nowrap">NIK</th>
										<th class="text-nowrap">Nama</th>
										@roleCanAccess(['0'])
											<th class="text-nowrap" data-orderable="false"></th>
										@endroleCanAccess
									</tr>
								</thead>
								<tbody>
									@php $num=1 @endphp
									@foreach($list as $data)
										<tr>
											<td>{{$num++}}</td>
											<td>{{$data->nik}}</td>
											<td>{{ucwords($data->name)}}</td>
											<!-- <td>{{$data->jk == '1' ? 'Laki-laki' : ($data->jk == '2' ? 'Perempuan' : '')}}</td> -->
											@roleCanAccess(['0'])
												<td>
													<a href="javascript:;" url="{{route('konfirmasi-pendaftaran-edit', $data->id)}}" class="edit_data" url-update="{{route('update-status-pendaftar', $data->id)}}"><i class="fas fa-lg fa-fw m-r-10 fa-edit text-warning"></i></a>
													<!-- <a href="{{route('karir-delete', $data->id)}}"><i class="fas fa-lg fa-fw m-r-10 fa-trash text-danger"></i></a> -->
												</td>
											@endroleCanAccess
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
			        // 'csv', 'excel', 'pdf', 'print'
			    ]
			});
		});

		//Tampilkan form modal edit
		$('.edit_data').click(function (){
			var url_update = $(this).attr('url-update');
			ajaxSetup;
			$.ajax({
			  url: $(this).attr('url'),
			  type:"GET",
			  success:function(response){
			    $('form[name=update]').attr('action', url_update)
			    $('input[name=name]').val(response.name)
			    $('input[name=no_hp]').val(response.no_hp)
			    $('input[name=nik]').val(response.nik)
			    $('input[name=tempat_lahir]').val(response.tempat_lahir)
			    $('input[name=tanggal_lahir]').val(response.tanggal_lahir)
			    $('input[name=tipe_wallet]').val(response.tipe_wallet)
			    $('input[name=no_wallet]').val(response.no_wallet)
			    $('textarea[name=alamat]').text(response.alamat)
			    $('img[name=surat]').attr('src', "{{asset('public')}}/"+response.surat_komitmen)
			    $('#edit_form').modal().show()
			  },
			});
		});
	</script>

@endpush

