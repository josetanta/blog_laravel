@extends('layouts.app')
@section('title','Registrarse')
@section('body')

<body class="bg-gradient-primary">

	<div class="container">

		<div class="card o-hidden border-0 shadow-lg my-5">
			<div class="card-body p-0">
				<!-- Nested Row within Card Body -->
				<div class="row">
					{{-- bg-register-image --}}
					<div class="col-lg-5 d-none d-lg-block "></div>
					<div class="col-lg-7">
						<div class="p-5">
							<div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Registrarse</h1>
							</div>

							<form method="POST" action="{{ route('register') }}" class="user">
								@csrf
								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input id="name" type="text" class="form-control form-control-user" name="name"
											value="{{ old('name') }}" required autocomplete="name" id="exampleFirstName" autofocus
											placeholder="Nombre">
										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="col-sm-6">
										<input type="text" required autofocus name="surname" class="form-control form-control-user" id="exampleLastName" placeholder="Apellido">
										@error('surname')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="form-group">
									<input class="form-control form-control-user" id="exampleInputEmail" type="email" name="email"
										value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>

								<div class="form-group row">
									<div class="col-sm-6 mb-3 mb-sm-0">
										<input class="form-control form-control-user" id="exampleInputPassword" type="password"
											name="password_confirmation" required autocomplete="new-password" placeholder="Contraseña">
									</div>
									<div class="col-sm-6">
										<input id="password" placeholder="Verifica tu Contraseña" type="password"
											class="form-control form-control-user" id="exampleRepeatPassword" name="password" required
											autocomplete="new-password">
										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<button type="submit" class="btn btn-primary btn-user btn-block">
									{{ __('Register') }}
								</button>
								<hr>
								{{-- <a href="{{ url('/') }}" class="btn btn-google btn-user btn-block">
									<i class="fab fa-google fa-fw"></i> Register with Google
								</a>
								<a href="{{ url('/') }}" class="btn btn-facebook btn-user btn-block">
									<i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
								</a> --}}
							</form>

							<!-- FORM LOGIN -->
							<hr>
							<div class="text-center">
								<a class="small" href="#">Forgot Password?</a>
							</div>
							<div class="text-center">
								<a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>
@endsection