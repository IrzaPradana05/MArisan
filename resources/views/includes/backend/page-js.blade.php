

<!-- ================== BEGIN BASE JS ================== -->
<script src="{{asset('assets/plugins/jquery/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!--[if lt IE 9]-->
<!--<script src="{{asset('assets/crossbrowserjs/html5shiv.js')}}"></script>-->
<!--<script src="{{asset('assets/crossbrowserjs/respond.min.js')}}"></script>-->
<!--<script src="{{asset('assets/crossbrowserjs/excanvas.min.js')}}"></script>-->
<!-- <![endif]-->
<script src="{{asset('assets/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('assets/plugins/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/js/theme/apple.min.js')}}"></script>
<script src="{{asset('assets/js/apps.min.js')}}"></script>
<!-- ================== END BASE JS ================== -->
<script>
	$(document).ready(function() {
		App.init();
	});
</script>
@stack('js')
