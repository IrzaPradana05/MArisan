<title>MArisan | @yield('title')</title>
<meta charset="utf-8" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<script type="text/javascript">
	var ajaxSetup = $.ajaxSetup({
		                  headers: {
		                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		                  }
		              });
</script>

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
<link href="{{asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/animate/animate.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/apple/style.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/apple/style-responsive.min.css')}}" rel="stylesheet" />
<link href="{{asset('assets/css/apple/theme/default.css')}}" rel="stylesheet" id="theme" />
<!-- ================== END BASE CSS STYLE ================== -->

<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
<link href="{{asset('assets/plugins/jquery-jvectormap/jquery-jvectormap.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<link href="{{asset('assets/plugins/gritter/css/jquery.gritter.css')}}" rel="stylesheet" />
<!-- ================== END PAGE LEVEL STYLE ================== -->
<script src="{{asset('assets/plugins/pace/pace.min.js')}}"></script>
@stack('css')

