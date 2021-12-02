<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('includes.backend.head')
</head>
<body>
	@include('sweetalert::alert')
	
	@yield('content')

	@include('includes.backend.footer')

	@include('includes.backend.page-js')
</body>
</html>
