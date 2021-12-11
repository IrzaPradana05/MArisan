
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="{{asset('assets/img/user/user-13.jpg')}}" alt="" />
                    </div>
                    <div class="info" style="text-transform: capitalize;">
                        <!-- <b class="caret"></b> -->
                        Halo, {{auth()->user()->name}}!
                        <small>{{auth()->user()->role == '0' ? 'Admin' : (auth()->user()->role == '1' ? 'Panitia' : (auth()->user()->role == '2' ? 'Anggota' : (auth()->user()->role == '3' ? 'Tamu' : '')))}}</small>
                    </div>
                </a>
            </li>
            <!-- <li>
                <ul class="nav nav-profile">
                    <li class=" {{Route::current()->getName() == 'setting' ? 'active' : ''}}"><a href="javascript:;"><i class="ion-ios-cog"></i> Setting</a></li>
                </ul>
            </li> -->
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header">Navigation</li>
            <!-- @roleCanAccess(['2'])
                @if(Auth::user()->status_aktif==0)
                <li class=" {{Request::segment(1) == 'konfirmasi-pendaftaran' ? 'active' : ''}}">
                    <a href="{{route('form-data-diri')}}">
                        <i class="ion-ios-person bg-purple"></i>
                        <span>Data Diri</span>
                    </a>
                </li>
                @endif
            @endroleCanAccess -->
            @roleCanAccess(['0','1','2'])
            @if(Auth::user()->status_aktif == 1)
                <li class=" {{Request::segment(1) == 'dashboard' ? 'active' : ''}}">
                    <a href="{{route('dashboard')}}">
                        <i class="ion-ios-home bg-blue"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="has-sub {{Request::segment(1) == 'arisan' ? 'active' : ''}}">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="ion-ios-desktop bg-green"></i>
                        <span>Arisan</span>
                    </a>
                    <ul class="sub-menu">
                        @roleCanAccess(['1'])
                            <li class="{{Request::segment(1) == 'arisan' && Request::segment(2) == '' ? 'active' : ''}}"><a href="{{route('arisan-index')}}">Daftar Arisan</a></li>
                        @endroleCanAccess
                        @roleCanAccess(['1','2'])
                            <li class="{{Request::segment(2) == 'arisan-saya' ? 'active' : ''}}"><a href="{{route('arisan-saya')}}">Arisan Saya</a></li>
                        @endroleCanAccess
                        @roleCanAccess(['0'])
                            <li class="{{Request::segment(2) == 'daftar-invoice' ? 'active' : ''}}"><a href="{{route('daftar-invoice')}}">Daftar Invoice</a></li>
                        @endroleCanAccess
                            <li class="{{Request::segment(2) == 'daftar-pemenang' ? 'active' : ''}}"><a href="{{route('daftar-pemenang')}}">Daftar Pemenang</a></li>
                    </ul>
                </li>
                @roleCanAccess(['0'])
                    <li class=" {{Request::segment(1) == 'konfirmasi-pendaftaran' ? 'active' : ''}}">
                        <a href="{{route('konfirmasi-pendaftaran-index')}}">
                            <i class="ion-ios-people bg-yellow"></i>
                            <span>Konfirmasi Pendaftaran</span>
                        </a>
                    </li>
                @endroleCanAccess
            @endif
            
            @endroleCanAccess
            
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-back"></i> <span>Sembunyikan</span></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
		