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
		<li class="dropdown navbar-user">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<img src="{{asset('assets/img/user/user-13.jpg')}}" alt="" />
				<span class="d-none d-md-inline" style="text-transform: capitalize;">{{auth()->user()->name}}</span> <b class="caret"></b>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="{{route('profil')}}" class="dropdown-item">Edit Profile</a>
				<!-- <a href="javascript:;" class="dropdown-item">Setting</a> -->
				<!-- <div class="dropdown-divider"></div> -->
				<a href="{{route('logout')}}" class="dropdown-item">Log Out</a>
			</div>
		</li>
	</ul>
	<!-- end header navigation right -->
</div>
<!-- end #header -->
