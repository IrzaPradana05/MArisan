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
				<li class="breadcrumb-item active">Lengkapi Data Diri</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Lengkapi Data Diri</h1>
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				@include('partials.validation')
				<!-- begin col-10 -->
				<div class="col-lg-12">
					<!-- begin panel -->
					<div class="panel panel-inverse">

						@if(Auth::user()->status_aktif == 0)
							<div class="note note-info note-with-left-icon">
							  <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
							  <div class="note-content text-left">
							    <h4><b>Data sedang diperiksa.</b></h4>
							    <p>Admin akan segera melakukan validasi pada data Anda.</p>
							  </div>
							</div>
						@else
							<!-- begin panel-heading -->
							<div class="panel-heading">
								<div class="panel-heading-btn">
									<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
								</div>
								<h4 class="panel-title">Data Pendaftar Baru</h4>
							</div>
							<!-- end panel-heading -->
							
							<div class="panel-body">

							<!-- begin panel-body -->
							<div class="panel-body">

								<form action="{{route('submit-data-diri',$data->id)}}" method="post" enctype="multipart/form-data">
									@csrf
									@method('post')
									<div class="row">
										<div class="col-md-12">
											<label for="name">Nama Lengkap</label>
											<input required type="text" class="form-control" name="name" id="name" value="{{$data->name}}"><br>
											<label for="no_hp">No HP</label>
											<input required type="text" class="form-control" name="no_hp" id="no_hp" value="{{$data->no_hp}}"><br>
											<label for="nik">NIK</label>
											<input required type="text" class="form-control" name="nik" id="nik" value="{{$data->nik}}"><br>
											<label for="jk">Jenis Kelamin</label>
											<select name="jk" class="form-control" required>
												<option value="1" {{$data->jk == 1 ? 'selected' : ''}}>Laki-laki</option>
												<option value="2" {{$data->jk == 2 ? 'selected' : ''}}>Perempuan</option>
											</select><br>
											<label for="tempat_lahir">Temp. Lahir</label>
											<input required type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" value="{{$data->tempat_lahir}}"><br>
											<label for="tanggal_lahir">Tgl. Lahir</label>
											<input required type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" value="{{$data->tanggal_lahir}}"><br>
											<label for="alamat">Alamat</label>
											<textarea required type="text" class="form-control" name="alamat" id="alamat">{{$data->alamat}}</textarea><br>
											<label for="surat_komitmen">Surat Komitmen</label>
											<input required type="file" class="form-control" name="surat_komitmen" id="surat_komitmen"><br>
											<label for="tipe_wallet">Tipe Wallet</label>
											<div class="row">
												<div class="col-md-12">
													<input required type="radio" class="" name="tipe_wallet" id="tipe_wallet1" value="Bank BCA" {{$data->tipe_wallet == 'Bank BCA' ? 'checked' : ''}}>
													<label for="tipe_wallet1">Bank BCA</label>
													<input style="margin-left:50px;" required type="radio" class="" name="tipe_wallet" id="tipe_wallet2" value="Bank BRI" {{$data->tipe_wallet == 'Bank BRI' ? 'checked' : ''}}>
													<label for="tipe_wallet2">Bank BRI</label>
													<input style="margin-left:50px;" required type="radio" class="" name="tipe_wallet" id="tipe_wallet3" value="Bank BNI" {{$data->tipe_wallet == 'Bank BNI' ? 'checked' : ''}}>
													<label for="tipe_wallet3">Bank BNI</label>
													<input style="margin-left:50px;" required type="radio" class="" name="tipe_wallet" id="tipe_wallet4" value="GO-PAY" {{$data->tipe_wallet == 'GO-PAY' ? 'checked' : ''}}>
													<label for="tipe_wallet4">GO-PAY</label>
													<input style="margin-left:50px;" required type="radio" class="" name="tipe_wallet" id="tipe_wallet5" value="OVO" {{$data->tipe_wallet == 'OVO' ? 'checked' : ''}}>
													<label for="tipe_wallet5">OVO</label>
													<input style="margin-left:50px;" required type="radio" class="" name="tipe_wallet" id="tipe_wallet6" value="DANA" {{$data->tipe_wallet == 'DANA' ? 'checked' : ''}}>
													<label for="tipe_wallet6">DANA</label>
												</div>
												<!-- <div class="col-md-3"></div> -->
												<!-- <div class="col-md-3"></div> -->
											</div>
											<label for="no_wallet">No. Wallet</label>
											<input required type="text" class="form-control" name="no_wallet" id="no_wallet" value="{{$data->no_wallet}}"><br>
										</div>
									</div>
									<div class="row">
										<div class="col-md-1">
										<input type="submit" class="btn btn-success" value="Kirim Data">
										</div>
										<div class="col-md-1">
										<input type="reset" class="btn btn-white" value="Reset">
										</div>
									</div>
								</form>

							</div>
							<!-- end panel-body -->
						</div>
						<!-- end panel -->
						@endif
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

		//Tampilkan form modal edit
		$('.edit_data').click(function (){
			var url_update = $(this).attr('url-update');
			ajaxSetup;
			$.ajax({
			  url: $(this).attr('url'),
			  type:"GET",
			  success:function(response){
			    $('form[name=update]').attr('action', url_update)
			    $('textarea[name=catatan_edit]').text(response['catatan'])
			    $('#edit_form').modal().show()
			  },
			});
		});
	</script>

@endpush

