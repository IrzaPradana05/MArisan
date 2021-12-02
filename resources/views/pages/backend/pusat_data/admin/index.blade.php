@extends('layouts.backend.index')
@section('title','Admin')
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
				<li class="breadcrumb-item active">Admin BK</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Data Admin</h1>
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
							<h4 class="panel-title">Data Master Admin</h4>
						</div>
						<!-- end panel-heading -->

						<div class="panel-body">
							<a href="#add_data" class="btn btn-primary btn-lg" data-toggle="modal">Tambah Data</a>
							<!-- #modal-without-animation -->
							<div class="modal" id="add_data">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Tambah Admin BK</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{route('admin-create')}}" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-12">
														<label for="nama">Nama <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="nama" id="nama"><br>
														<label for="email">E-mail <small class="text-danger">*</small></label><br>
														<input required type="text" class="form-control" name="email" id="email"><br>
														<label for="password">Password <small class="text-danger">*</small></label>
														<!-- <input required type="text" class="form-control" name="password" id="password"><br> -->
														<input required data-toggle="password" data-placement="after" class="form-control" type="password" name="password" id="password"/><br>
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
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Edit Data Admin BK</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form name="update" action="" method="post">
												@csrf
												@method('put')
												<div class="row">
													<div class="col-md-12">
														<label for="nama_edit">Nama <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="nama_edit" id="nama_edit"><br>
														<label for="email_edit">E-mail <small class="text-danger">*</small></label><br>
														<input required type="text" class="form-control" name="email_edit" id="email_edit" readonly><br>
														<label for="password_edit">Password <small class="text-danger">*</small></label>
														<!-- <input required type="text" class="form-control" name="password_edit" id="password_edit"><br> -->
														<input required data-toggle="password" data-placement="after" class="form-control" type="password" name="password_edit" id="password_edit"/><br>
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
										<th class="text-nowrap">Nama</th>
										<th class="text-nowrap">E-mail</th>
										<th class="text-nowrap" data-orderable="false">Aksi</th>
									</tr>
								</thead>
								<tbody>
									@php $num=1 @endphp
									@foreach($user as $data)
										<tr>
											<td>{{$num++}}</td>
											<td>{{ucwords($data->name)}}</td>
											<td>{{$data->email}}</td>
											<td>
												<a href="javascript:;" url="{{route('admin-ajax-edit', $data->id)}}" class="edit_data" url-update="{{route('admin-update', $data->id)}}"><i class="fas fa-lg fa-fw m-r-10 fa-edit text-warning"></i></a>
												<a href="{{route('admin-delete', $data->id)}}"><i class="fas fa-lg fa-fw m-r-10 fa-trash text-danger"></i></a>
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

		//Tampilkan form modal edit
		$('.edit_data').click(function (){
			var url_update = $(this).attr('url-update');
			ajaxSetup;
			$.ajax({
			  url: $(this).attr('url'),
			  type:"GET",
			  success:function(response){
			    $('form[name=update]').attr('action', url_update)
			    $('input[name=nama_edit]').val(response['name'])
			    $('input[name=email_edit]').val(response['email'])
			    $('input[name=password_edit]').val()
			    $('#edit_form').modal().show()
			  },
			});
		});
	</script>

@endpush

