<!-- begin #header -->
<div id="header" class="header navbar-default">
	<!-- begin navbar-header -->
	<div class="navbar-header">
		<a href="{{route('dashboard')}}" class="navbar-brand"><span class="navbar-logo"><i class="ion-ios-book"></i></span> <b>M</b>Arisan</a>
		<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<!-- end navbar-header -->

	<!-- begin header-nav -->
	<ul class="navbar-nav navbar-right">
		@roleCanAccess(['0','1'])
			<li class="dropdown">
				<a href="#" data-toggle="dropdown" class="dropdown-toggle icon">
					<i class="ion-ios-chatboxes"></i>
					@if($total_messages > 0)
						<span class="label">{{$total_messages}}</span>
					@else
					@endif
				</a>
				<ul class="dropdown-menu media-list dropdown-menu-right">
					<li class="dropdown-header">PESAN BARU ({{$total_messages}})</li>
					@foreach($messages as $data)
						<li class="media">
							<a href="{{route('chat-panel',$data->id_user_pengirim)}}">
								<div class="media-left">
									<img src="{{asset('assets/img/user/user-1.jpg')}}" class="media-object" alt="" />
									<i class="fab fa-facebook-messenger text-primary media-object-icon"></i>
								</div>
								<div class="media-body">
									<h6 class="media-heading">{{ucwords($data->nama_pengirim)}} <span class="badge badge-pink">Baru</span></h6>
									<p>Anda telah menerima pesan baru.</p>
									<div class="text-muted f-s-11">{{format_tanggal($data->tanggal,false,true)}}</div>
								</div>
							</a>
						</li>
					@endforeach
					<li class="dropdown-footer text-center">
						<a href="{{route('chat-index')}}">Daftar Kontak</a>
					</li>
				</ul>
			</li>
		@endroleCanAccess
		<li class="dropdown navbar-user">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<img src="{{asset('assets/img/user/user-13.jpg')}}" alt="" />
				<span class="d-none d-md-inline" style="text-transform: capitalize;">{{auth()->user()->name}}</span> <b class="caret"></b>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<!-- <a href="javascript:;" class="dropdown-item">Edit Profile</a> -->
				<!-- <a href="javascript:;" class="dropdown-item">Setting</a> -->
				<!-- <div class="dropdown-divider"></div> -->
				<a href="{{route('logout')}}" class="dropdown-item">Log Out</a>
			</div>
		</li>
	</ul>
	<!-- end header navigation right -->
</div>
<!-- end #header -->
