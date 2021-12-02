@extends('layouts.backend.index')
@section('title','dashboard')
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
				<li class="breadcrumb-item active">Kamar</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Data Kamar</h1>
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
							<h4 class="panel-title">Data Master Kamar</h4>
						</div>
						<!-- end panel-heading -->

						<div class="panel-body">
							<a href="#add_data" class="btn btn-primary btn-lg" data-toggle="modal">Tambah Data</a>
							<!-- #modal-without-animation -->
							<div class="modal" id="add_data">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Tambah Kamar</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{route('kamar-create')}}" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-6">
														<label for="nama">Nama Kamar <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="nama" id="nama"><br>
														<label for="kapasitas">Kapasitas <small class="text-danger">*</small></label>
														<input required type="number" class="form-control" name="kapasitas" id="kapasitas"><br>
														<label for="luas">Luas <small class="text-danger"></small></label>
														<input type="text" class="form-control" name="luas" id="luas"><br>
														<label for="fasilitas">Fasilitas <small class="text-danger"></small></label>
														<input type="text" class="form-control" name="fasilitas" id="fasilitas"><br>
													</div>
													<div class="col-md-6">
														<label for="tahunan">Biaya Tahunan <small class="text-danger"></small></label>
														<input type="number" class="form-control" name="tahunan" id="tahunan"><br>
														<label for="bulanan">Biaya Bulanan <small class="text-danger"></small></label>
														<input type="number" class="form-control" name="bulanan" id="bulanan"><br>
														<label for="mingguan">Biaya Mingguan <small class="text-danger"></small></label>
														<input type="number" class="form-control" name="mingguan" id="mingguan"><br>
														<label for="harian">Biaya Harian <small class="text-danger"></small></label>
														<input type="number" class="form-control" name="harian" id="harian"><br>
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
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Edit Data Kamar</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form name="update" action="" method="post">
												@csrf
												@method('put')
												<div class="row">
													<div class="col-md-6">
														<label for="nama_edit">Nama Kamar <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="nama_edit" id="nama_edit"><br>
														<label for="kapasitas_edit">Kapasitas <small class="text-danger">*</small></label>
														<input required type="number" class="form-control" name="kapasitas_edit" id="kapasitas_edit"><br>
														<label for="luas_edit">Luas <small class="text-danger"></small></label>
														<input type="text" class="form-control" name="luas_edit" id="luas_edit"><br>
														<label for="fasilitas_edit">Fasilitas <small class="text-danger"></small></label>
														<input type="text" class="form-control" name="fasilitas_edit" id="fasilitas_edit"><br>
													</div>
													<div class="col-md-6">
														<label for="tahunan_edit">Biaya Tahunan <small class="text-danger"></small></label>
														<input type="number" class="form-control" name="tahunan_edit" id="tahunan_edit"><br>
														<label for="bulanan_edit">Biaya Bulanan <small class="text-danger"></small></label>
														<input type="number" class="form-control" name="bulanan_edit" id="bulanan_edit"><br>
														<label for="mingguan_edit">Biaya Mingguan <small class="text-danger"></small></label>
														<input type="number" class="form-control" name="mingguan_edit" id="mingguan_edit"><br>
														<label for="harian_edit">Biaya Harian <small class="text-danger"></small></label>
														<input type="number" class="form-control" name="harian_edit" id="harian_edit"><br>
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
										<th class="text-nowrap">Kapasitas</th>
										<th class="text-nowrap">Luas</th>
										<th class="text-nowrap">Fasilitas</th>
										<th class="text-nowrap">Tahunan</th>
										<th class="text-nowrap">Bulanan</th>
										<th class="text-nowrap">mingguan</th>
										<th class="text-nowrap">Harian</th>
										<th class="text-nowrap" data-orderable="false">Action</th>
									</tr>
								</thead>
								<tbody>
									@php $num=1 @endphp
									@foreach($kamar as $data)
										<tr>
											<td>{{$num++}}</td>
											<td>{{$data->nama_kamar}}</td>
											<td>{{$data->kapasitas}}</td>
											<td>{{$data->luas}}</td>
											<td>{{$data->fasilitas}}</td>
											<td>{{$data->tahunan}}</td>
											<td>{{$data->bulanan}}</td>
											<td>{{$data->mingguan}}</td>
											<td>{{$data->harian}}</td>
											<td>
												<a href="javascript:;" url="{{route('kamar-ajax-edit', $data)}}" class="edit_data" url-update="{{route('kamar-update', $data)}}"><i class="fas fa-lg fa-fw m-r-10 fa-edit text-warning"></i></a>
												<a href="{{route('kamar-delete', $data->id_kamar)}}"><i class="fas fa-lg fa-fw m-r-10 fa-trash text-danger"></i></a>
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
	<script src="{{asset('assets/plugins/gritter/js/jquery.gritter.js')}}"></script>
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

		//Input Number Only
		$('input[name=kapasitas]').on('change', function(){
			if ($(this).val() < 0) {
				var val = $(this).val()*(-1);
				$(this).val(val)
			};
		});
		$('input[name=tahunan]').on('change', function(){
			if ($(this).val() < 0) {
				var val = $(this).val()*(-1);
				$(this).val(val)
			};
		});
		$('input[name=bulanan]').on('change', function(){
			if ($(this).val() < 0) {
				var val = $(this).val()*(-1);
				$(this).val(val)
			};
		});
		$('input[name=mingguan]').on('change', function(){
			if ($(this).val() < 0) {
				var val = $(this).val()*(-1);
				$(this).val(val)
			};
		});
		$('input[name=harian]').on('change', function(){
			if ($(this).val() < 0) {
				var val = $(this).val()*(-1);
				$(this).val(val)
			};
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
			    $('input[name=nama_edit]').val(response['nama_kamar'])
			    $('input[name=kapasitas_edit]').val(response['kapasitas'])
			    $('input[name=luas_edit]').val(response['luas'])
			    $('input[name=fasilitas_edit]').val(response['fasilitas'])
			    $('input[name=tahunan_edit]').val(response['tahunan'])
			    $('input[name=bulanan_edit]').val(response['bulanan'])
			    $('input[name=mingguan_edit]').val(response['mingguan'])
			    $('input[name=harian_edit]').val(response['harian'])
			    $('#edit_form').modal().show()
			  },
			});
		});
	</script>

	<!-- Notifikasi setelah submit action -->
	@if(Session::get('notif_add'))
	<script type="text/javascript">
		// function(){
			$.gritter.add({
			    title: "SUCCESS!",
			    text: "Data berhasil ditambahkan.",
			    // class_name: "gritter-light"
			  })
		// };
	</script>
	@endif
	@if(Session::get('notif_update'))
	<script type="text/javascript">
		// function(){
			$.gritter.add({
			    title: "SUCCESS!",
			    text: "Data berhasil diperbarui.",
			    // class_name: "gritter-light"
			  })
		// };
	</script>
	@endif
	@if(Session::get('notif_delete'))
	<script type="text/javascript">
		// function(){
			$.gritter.add({
			    title: "SUCCESS!",
			    text: "Data berhasil dihapus.",
			    // class_name: "review"
			  })
		// };
	</script>
	@endif

	<!-- Clear session notifikasi -->
	@php
		Session::forget('notif_add');
		Session::forget('notif_update'); 
		Session::forget('notif_delete');
	@endphp
@endpush

