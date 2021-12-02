@extends('layouts.backend.index')
@section('title','Pelanggaran')
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
				<li class="breadcrumb-item active">Pelanggaran Siswa</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Data Pelanggaran</h1>
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
							<h4 class="panel-title">Data Pelanggaran Siswa</h4>
						</div>
						<!-- end panel-heading -->

						<div class="panel-body">
							@roleCanAccess(['0'])
								<a href="#add_data" class="btn btn-primary btn-lg" data-toggle="modal">Tambah Data</a>
							@endroleCanAccess
							<!-- #modal-without-animation -->
							<div class="modal" id="add_data">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Data Pelanggaran Siswa</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{route('pelanggaran-create')}}" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-12">
														<label for="nis">NIS <small class="text-danger">*</small></label>
														<!-- <input required type="text" class="form-control" name="nis" id="nis"><br> -->
														<select required class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="nis" id="nis">
															<option value="">Pilih Data Siswa</option>
															@foreach($siswa as $data)
																<option value="{{$data->nis}}">{{$data->nis}} - {{ucwords($data->nama)}}</option>
															@endforeach
														</select><br><br>
														<label for="kategori">Kategori Pelanggaran <small class="text-danger">*</small></label>
														<select required type="text" class="form-control" name="kategori" id="kategori">
															<option value="ringan">Ringan</option>
															<option value="sedang">Sedang</option>
															<option value="berat">Berat</option>
														</select><br>
														<label for="poin">Poin Pelanggaran <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="poin" id="poin" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"><br>
														<label for="pelanggaran">Pelanggaran <small class="text-danger">*</small></label>
														<textarea required type="text" class="form-control" name="pelanggaran" id="pelanggaran"></textarea><br>
														<label for="sanksi">Sanksi <small class="text-danger"></small></label>
														<textarea type="text" class="form-control" name="sanksi" id="sanksi"></textarea><br>
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
											<h4 class="modal-title">Edit Data Pelanggaran Siswa</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form name="update" action="" method="post">
												@csrf
												@method('put')
												<div class="row">
													<div class="col-md-12">
														<label for="kategori_edit">Kategori Pelanggaran <small class="text-danger">*</small></label>
														<select required type="text" class="form-control" name="kategori_edit" id="kategori_edit">
															<option value="ringan">Ringan</option>
															<option value="sedang">Sedang</option>
															<option value="berat">Berat</option>
														</select><br>
														<label for="poin_edit">Poin Pelanggaran <small class="text-danger">*</small></label>
														<input required type="text" class="form-control" name="poin_edit" id="poin_edit"><br>
														<label for="pelanggaran_edit">Pelanggaran <small class="text-danger">*</small></label>
														<textarea required type="text" class="form-control" name="pelanggaran_edit" id="pelanggaran_edit"></textarea><br>
														<label for="sanksi_edit">Sanksi <small class="text-danger"></small></label>
														<textarea type="text" class="form-control" name="sanksi_edit" id="sanksi_edit"></textarea><br>
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
										<th class="text-nowrap">Kategori</th>
										<th class="text-nowrap">Poin Pelanggaran</th>
										<th class="text-nowrap">Pelanggaran</th>
										<th class="text-nowrap">Sanksi</th>
										<th class="text-nowrap">Tanggal</th>
										<th class="text-nowrap">Penulis</th>
										@roleCanAccess(['0'])
											<th class="text-nowrap" data-orderable="false">Aksi</th>
										@endroleCanAccess
									</tr>
								</thead>
								<tbody>
									@php $num=1 @endphp
									@foreach($pelanggaran as $data)
										<tr>
											<td>{{$num++}}</td>
											<td>{{$data->nis_pelanggar}}</td>
											<td>{{ucwords($data->nama)}}</td>
											<td>{{$data->kelas}}</td>
											<td><span class="badge {{$data->kategori_pelanggaran == 'ringan' ? 'badge-success' : ($data->kategori_pelanggaran == 'sedang' ? 'badge-warning' : ($data->kategori_pelanggaran == 'berat' ? 'badge-danger' : ''))}}">{{ucfirst($data->kategori_pelanggaran)}}</span></td>
											<td>{{$data->poin_pelanggaran}}</td>
											<td>{{ucfirst($data->pelanggaran)}}</td>
											<td>{{ucfirst($data->sanksi)}}</td>
											<td>{{format_tanggal($data->tanggal,true,false)}}</td>
											<td>{{ucwords($data->penulis)}}</td>
											@roleCanAccess(['0'])
												<td>
													<a href="javascript:;" url="{{route('pelanggaran-ajax-edit', $data->id)}}" class="edit_data" url-update="{{route('pelanggaran-update', $data->id)}}"><i class="fas fa-lg fa-fw m-r-10 fa-edit text-warning"></i></a>
													<a href="{{route('pelanggaran-delete', $data->id)}}"><i class="fas fa-lg fa-fw m-r-10 fa-trash text-danger"></i></a>
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
			    $('input[name=poin_edit]').val(response['poin_pelanggaran'])
			    $('select[name=kategori_edit]').val(response['kategori_pelanggaran'])
			    $('textarea[name=pelanggaran_edit]').text(response['pelanggaran'])
			    $('textarea[name=sanksi_edit]').text(response['sanksi'])
			    $('#edit_form').modal().show()
			  },
			});
		});
	</script>

@endpush

