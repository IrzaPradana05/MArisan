
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
            @roleCanAccess(['0'])
            <li class=" {{Request::segment(1) == 'dashboard' ? 'active' : ''}}">
                <a href="{{route('dashboard')}}">
                    <i class="ion-ios-home bg-blue"></i>
                    <span>Dashboard</span>
                </a>
            </li>
                <li class="has-sub {{Request::segment(1) == 'pusat-data' ? 'active' : ''}}">
                    <a href="javascript:;">
                        <b class="caret"></b>
                        <i class="ion-ios-desktop bg-green"></i>
                        <span>Pusat Data</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="{{Request::segment(2) == 'kelas' ? 'active' : ''}}"><a href="{{route('kelas-index')}}">Kelas</a></li>
                        <li class="{{Request::segment(2) == 'admin' ? 'active' : ''}}"><a href="{{route('admin-index')}}">Admin BK</a></li>
                        <li class="{{Request::segment(2) == 'siswa' ? 'active' : ''}}"><a href="{{route('siswa-index')}}">Siswa</a></li>
                        <li class="{{Request::segment(2) == 'wali' ? 'active' : ''}}"><a href="{{route('wali-index')}}">Wali</a></li>
                    </ul>
                </li>
            <li class=" {{Request::segment(1) == 'pelanggaran' ? 'active' : ''}}">
                <a href="{{route('pelanggaran-index')}}">
                    <i class="ion-ios-book bg-red"></i>
                    <span>Pelanggaran Siswa</span>
                </a>
            </li>
            @endroleCanAccess
            @roleCanAccess(['0'])
                <li class=" {{Request::segment(1) == 'surat-tindak' ? 'active' : ''}}">
                    <a href="{{route('surat-tindak-index')}}">
                        <i class="ion-ios-document bg-yellow"></i>
                        <span>Surat Tindak Lanjut</span>
                    </a>
                </li>
            @endroleCanAccess
            @roleCanAccess(['0'])
            <li class=" {{Request::segment(1) == 'prestasi' ? 'active' : ''}}">
                <a href="{{route('prestasi-index')}}">
                    <i class="ion-ios-trophy bg-purple"></i>
                    <span>Prestasi Siswa</span>
                </a>
            </li>
            <li class=" {{Request::segment(1) == 'arisan' ? 'active' : ''}}">
                <a href="{{route('arisan-index')}}">
                    <i class="ion-ios-trophy bg-purple"></i>
                    <span>Arisan</span>
                </a>
            </li>
            <li class=" {{Request::segment(1) == 'konseling' ? 'active' : ''}}">
                <a href="{{route('konseling-index')}}">
                    <i class="ion-ios-people bg-indigo"></i>
                    <span>Bimbingan Konseling</span>
                </a>
            </li>
            <li class=" {{Request::segment(1) == 'karir' ? 'active' : ''}}">
                <a href="{{route('karir-index')}}">
                    <i class="ion-ios-people bg-teal"></i>
                    <span>Bimbingan Karir</span>
                </a>
            </li>
            <li class=" {{Request::segment(1) == 'pengumuman' || Request::segment(1) == 'psikotes' || Request::segment(1) == 'peserta-psikotes' ? 'active' : ''}}">
                <a href="{{route('pengumuman-index')}}">
                    <i class="ion-ios-create bg-grey"></i>
                    <span>Psikotes</span>
                </a>
            </li>
            <li class=" {{Request::segment(1) == 'reflin' ? 'active' : ''}}">
                <a href="{{route('reflin-index')}}">
                    <i class="ion-ios-create bg-cyan"></i>
                    <span>Tes Reflin</span>
                </a>
            </li>
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
		