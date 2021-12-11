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
				<li class="breadcrumb-item active">Arisan Saya</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Arisan Saya</h1>
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
							<h4 class="panel-title">Data Arisan</h4>
						</div>
						<!-- end panel-heading -->

						<div class="panel-body">
							<!-- #modal-without-animation -->
							<div class="modal" id="add_data">
								<div class="modal-dialog modal-md">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Data Arisan</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form action="{{route('arisan-create')}}" method="post">
												@csrf
												@method('post')
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
									                        <label for="nama_arisan">Nama Arisan</label>
									                          <input type="text" class="form-control" id="nama_arisan" name="nama_arisan" required="required" placeholder="Masukkan Nama Arisan ..." >
									                    </div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
									                        <label for="jumlah_slot">Jumlah Slot</label>
									                          <input type="text" class="form-control" id="jumlah_slot" name="jumlah_slot" required="required" placeholder="Masukkan Jumlah slot ..." >
									                    </div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
									                        <label for="iuran_perbulan">Iuran Perbulan</label>
									                          <input type="text" class="form-control" id="iuran_perbulan" name="iuran_perbulan" required="required" placeholder="Masukkan Iuran Perbulan ..." >
									                    </div>
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
											<h4 class="modal-title">Edit Data Arisan</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										</div>
										<div class="modal-body">
											<form name="update" action="" method="post">
												@csrf
												@method('put')
												<div class="row">
													<div class="col-md-12">
														<div class="form-group">
									                        <label for="nama_arisan">Nama Arisan</label>
									                          <input type="text" class="form-control" id="nama_arisan" name="nama_arisan" required="required" value="" >
									                    </div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
									                        <label for="jumlah_slot">Jumlah Slot</label>
									                          <input type="text" class="form-control" id="jumlah_slot" name="jumlah_slot" required="required" value="" >
									                    </div>
													</div>

													<div class="col-md-12">
														<div class="form-group">
									                        <label for="iuran_perbulan">Iuran Perbulan</label>
									                          <input type="text" class="form-control" id="iuran_perbulan" name="iuran_perbulan" required="required" value="" >
									                    </div>
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
										<th class="text-nowrap">Nama Arisan</th>
										<th class="text-nowrap">Slot</th>
										<th class="text-nowrap">Iuran Perbulan</th>
										<th class="text-nowrap">Status Arisan</th>
										<th class="text-nowrap">Tanggal</th>
										<th class="text-nowrap">Penulis</th>
										<th class="text-nowrap" data-orderable="false"></th>
									</tr>
								</thead>
								<tbody>
									@php $num=1 @endphp
									@foreach($arisan as $data)
										<tr>
											<td>{{$num++}}</td>
											<td>{{$data->nama_arisan}}</td>
											<td>{{$data->slot_terisi}}/{{$data->jumlah_slot}} Orang</td>
											<td>{{rupiah($data->iuran_perbulan)}}</td>
											<td><span class="{{status_arisan($data->status_arisan)[1]}}"><b>{{status_arisan($data->status_arisan)[0]}}</b></span></td>
											<td>{{format_tanggal($data->created_date,true,false)}}</td>
											<td>{{ucwords($data->pembuat)}}</td>
											@if($data->status_arisan == '2')
												<td>
													<a href="{{route('tanggungan-arisan', $data->id_arisan)}}"><i class="fas fa-lg fa-fw m-r-10 text-warning">Bayar</i></a>
												</td>
											@endif
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
			        'pdf'
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
			    $('input[name=nama_arisan]').val(response.nama_arisan)
			    $('input[name=jumlah_slot]').val(response.jumlah_slot)
			    $('input[name=iuran_perbulan]').val(response.iuran_perbulan)
			    $('#edit_form').modal().show()
			  },
			});
		});
	</script>

@endpush

