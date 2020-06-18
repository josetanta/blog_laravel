@extends('layouts.app')

@section('title','Log In')

@section('body')

<body class="bg-gradient-primary">
	<div class="container">
		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-10 col-lg-12 col-md-9">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							{{-- bg-login-image --}}
							<div class="col-lg-6 d-none d-lg-block"></div>
							
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
									</div>
									<form method="POST" action="{{ route('login') }}" class="user">
										@csrf
										<div class="form-group">
											<input placeholder="Enter Email Address..." id="exampleInputEmail" type="email"
												class="form-control form-control-user" name="email" value="{{ old('email') }}" required
												autocomplete="email" autofocus>
											@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>

										<div class="form-group">
											<input id="exampleInputPassword" type="password" class="form-control form-control-user"
												name="password" required autocomplete="current-password" placeholder="Password">
											@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<div class="custom-control custom-checkbox small">
												<input type="checkbox" class="custom-control-input" id="customCheck">
												<label class="custom-control-label" for="customCheck">Remember Me</label>
											</div>
										</div>
										<button type="submit" class="btn btn-primary btn-user btn-block">
											{{ __('Login') }}
										</button>

										<hr>
										<a href="#" class="btn btn-google btn-user btn-block">
											<i class="fab fa-google fa-fw"></i> Login with Google
										</a>
										<a href="#" class="btn btn-facebook btn-user btn-block">
											<i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
										</a>
									</form>
									<hr>
									<div class="text-center">
										@if (Route::has('password.request'))
										<a class="small" href="{{ route('password.request') }}">
											{{ __('Forgot Your Password?') }}
										</a>
										@endif
									</div>
									<div class="text-center">
										<a class="small" href="{{ route('register') }}">Create an Account!</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
@endsection