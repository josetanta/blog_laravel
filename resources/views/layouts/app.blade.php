<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{ asset('icon/laravel.ico') }}" rel="shortcut icon" type="image/ico">
	<title>{{ ucfirst(config('app.name')) }} | @yield('title','Home')</title>

	<!-- Scripts -->
	<script src="{{ asset('static_dashboard/vendor/jquery/jquery.min.js')}}" defer></script>
	<script src="{{ asset('static_dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" defer></script>


	<!-- Core plugin JavaScript-->
	{{-- <script src="{{ asset('static_dashboard/vendor/jquery-easing/jquery.easing.min.js')}}" defer></script> --}}

	<!-- Custom scripts for all pages-->
	<script src="{{ asset('static_dashboard/js/sb-admin-2.min.js')}}" defer></script>

	<!-- Page level plugins -->
	{{-- <script src="{{ asset('static_dashboard/vendor/chart.js/Chart.min.js')}}" defer></script> --}}

	<!-- Page level custom scripts -->
	{{-- <script src="{{ asset('static_dashboard/js/demo/chart-area-demo.js') }}" defer></script> --}}
	{{-- <script src="{{ asset('static_dashboard/js/demo/chart-pie-demo.js')}}" defer></script> --}}

	<!-- Page level custom scripts -->
	{{-- <script src="{{asset('static_dashboard/js/demo/datatables-demo.js')}}" defer></script> --}}

	<!-- Custom fonts for this template-->
	<link href="{{asset('static_dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

	<!-- Custom styles for this template-->
	<link href="{{asset('static_dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">
	<link href="{{asset('static_dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
	<link href="{{asset('css/account.css')}}" rel="stylesheet">
	<link href="{{asset('css/main.css')}}" rel="stylesheet">
</head>
<body>
@yield('body')
</body>
</html>