@extends('layouts.backend.index')
@section('title','Wali')
@section('content')
@push('css')
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{asset('assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/DataTables/extensions/FixedColumns/css/fixedColumns.bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/DataTables/extensions/Buttons/css/buttons.bootstrap.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />
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
				<li class="breadcrumb-item active">Wali Murid</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Data Wali Murid</h1>
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
							<h4 class="panel-title">Data Master Wali</h4>
						</div>
						<!-- end panel-heading -->

						<div class="panel-body">
							<a href="#add_data" class="btn btn-primary btn-lg" data-toggle="modal">Tambah Data</a>
							<!-- #modal-without-animation -->
							<div class="modal" id="add_data">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Tambah Wali Murid</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{route('wali-create')}}" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-6">
														<label for="no_ktp">No. KTP <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="no_ktp" id="no_ktp" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><br>
														<label for="nama">Nama <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="nama" id="nama"><br>
														<label for="no_telp">No. Telepon <small class="text-danger">*</small></label>
														<input type="text" class="form-control" name="no_telp" id="no_telp"><br>
													</div>
													<div class="col-md-6">
														<label for="alamat">Alamat <small class="text-danger">*</small></label><br>
														<input type="text" class="form-control" name="alamat" id="alamat"><br>
														<label for="email">E-mail <small class="text-danger">*</small></label><br>
														<input required type="text" class="form-control" name="email" id="email"><br>
														<!-- <label for="password">Password <small class="text-danger">*</small></label> -->
														<!-- <input required data-toggle="password" data-placement="after" class="form-control" type="password" name="password" id="password"/><br> -->
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
											<h4 class="modal-title">Edit Data Wali Murid</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form name="update" action="" method="post">
												@csrf
												@method('put')
												<div class="row">
													<div class="col-md-6">
														<label for="no_ktp_edit">No. KTP <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="no_ktp_edit" id="no_ktp_edit" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><br>
														<label for="nama_edit">Nama <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="nama_edit" id="nama_edit"><br>
														<label for="email_edit">E-mail <small class="text-danger">*</small></label><br>
														<input required type="text" class="form-control" name="email_edit" id="email_edit"><br>
													</div>
													<div class="col-md-6">
														<label for="no_telp_edit">No. Telepon <small class="text-danger">*</small></label>
														<input type="text" class="form-control" name="no_telp_edit" id="no_telp_edit"><br>
														<label for="alamat_edit">Alamat <small class="text-danger">*</small></label><br>
														<input type="text" class="form-control" name="alamat_edit" id="alamat_edit"><br>
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
										<th class="text-nowrap">No. KTP</th>
										<th class="text-nowrap">Nama</th>
										<th class="text-nowrap">E-mail</th>
										<th class="text-nowrap">No. Telepon</th>
										<th class="text-nowrap">Alamat</th>
										<th class="text-nowrap" data-orderable="false">Aksi</th>
									</tr>
								</thead>
								<tbody>
									@php $num=1 @endphp
									@foreach($wali as $data)
										<tr>
											<td>{{$num++}}</td>
											<td>{{$data->no_ktp}}</td>
											<td>{{ucwords($data->nama)}}</td>
											<td>{{$data->email}}</td>
											<td>{{$data->no_telp}}</td>
											<td>{{$data->alamat}}</td>
											<td>
												<a href="javascript:;" url="{{route('wali-ajax-edit', $data->id)}}" class="edit_data" url-update="{{route('wali-update', $data->id)}}"><i class="fas fa-lg fa-fw m-r-10 fa-edit text-warning"></i></a>
												<a href="{{route('wali-delete', $data->id)}}"><i class="fas fa-lg fa-fw m-r-10 fa-trash text-danger"></i></a>
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
	<script src="{{asset('assets/plugins/bootstrap-show-password/bootstrap-show-password.js')}}"></script>
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
			    // $("input[name=no_ktp_edit]").mask("99999999999999999999");
			    $('input[name=no_ktp_edit]').val(response['no_ktp'])
			    $('input[name=nama_edit]').val(response['nama'])
			    $('input[name=email_edit]').val(response['email'])
			    $('input[name=no_telp_edit]').val(response['no_telp'])
			    $('input[name=alamat_edit]').val(response['alamat'])
			    $('#edit_form').modal().show()
			  },
			});
		});
	</script>

@endpush

