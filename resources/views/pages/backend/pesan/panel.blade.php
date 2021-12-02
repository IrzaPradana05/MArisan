@extends('layouts.backend.index')
@section('title','Pesan')
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
				<li class="breadcrumb-item active">Pesan</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header">Pesan</h1>
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
							<h4 class="panel-title">Kotak Pesan</h4>
						</div>
						<!-- end panel-heading -->



						<!-- begin panel-body -->
						<div class="panel-body">
							<div class="height-sm chat-container" data-scrollbar="true" id="chat-container">
								<ul class="media-list media-list-with-divider">
									@foreach($pesan as $data)
										<li class="media media-sm">
											<a href="javascript:;" class="pull-left">
											<img src="{{$data->role == '0' ? asset('assets/img/user/user-1.jpg') : asset('assets/img/user/user-12.jpg')}}" alt="" class="media-object rounded-corner" />
											</a>
											<div class="media-body">
												<a href="javascript:;">
													<h4 class="media-heading">{{$data->id_user_pengirim == Auth::user()->id ? 'Anda' : ucwords($data->nama_pengirim)}}</h4>
												</a>
												<p class="m-b-5">
													{{ucfirst($data->teks)}}
												</p>
												<i class="text-muted">{{format_tanggal($data->tanggal)}}</i>
											</div>
										</li>
									@endforeach
								</ul>
							</div>
						</div>
						<div class="panel-footer">
							<form action="{{route('chat-create')}}" method="post">
								@csrf
								@method('post')
								<div class="input-group">
									<input type="text" class="form-control bg-silver" value="{{$id_user_penerima}}" name="id_user_penerima" hidden />
									<input type="text" class="form-control bg-silver" name="teks" placeholder="Enter message" />
									<span class="input-group-append">
									<button class="btn btn-primary" type="submit"><i class="fa fa-pencil-alt"></i></button>
									</span>
								</div>
							</form>
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
		window.onload=function () {
		     var objDiv = document.getElementById("chat-container");
     		 objDiv.scrollTop = objDiv.scrollHeight;
		}
		// $(document).ready(function() {
		// 	var objDiv = document.getElementById("chat-container");
		// 	objDiv.scrollTop = objDiv.scrollHeight;

		// 	$('#data-table-kamar').DataTable({
		// 		dom: 'Bfrtip',
		// 	    buttons: [
		// 	        'csv', 'excel', 'pdf', 'print'
		// 	    ]
		// 	});
		// });


		// function isNumber(evt) {
		//     evt = (evt) ? evt : window.event;
		//     var charCode = (evt.which) ? evt.which : evt.keyCode;
		//     if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		//         return false;
		//     }
		//     return true;
		// }

		// //Tampilkan form modal edit
		// $('.edit_data').click(function (){
		// 	var url_update = $(this).attr('url-update');
		// 	ajaxSetup;
		// 	$.ajax({
		// 	  url: $(this).attr('url'),
		// 	  type:"GET",
		// 	  success:function(response){
		// 	    $('form[name=update]').attr('action', url_update)
		// 	    $('input[name=nilai_edit]').val(response['nilai'])
		// 	    $('#edit_form').modal().show()
		// 	  },
		// 	});
		// });
	</script>

@endpush

