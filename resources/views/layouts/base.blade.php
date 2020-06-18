@extends('layouts.app')

@section('body')

	@include('partial._navbar')
	<main role="main" class="container m-4">
		<div class="col-sm-8">@include('layouts.flash-message')</div>
		@yield('content-base')
	</main>
	<footer class="sticky-footer bg-white">
		<div class="container my-auto">
			<div class="copyright text-center my-auto">
				<span>Copyright &copy; Your Website 2020</span>
			</div>
		</div>
	</footer>

@endsection