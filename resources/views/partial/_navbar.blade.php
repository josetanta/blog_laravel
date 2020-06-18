<nav class="navbar navbar-expand-md navbar-light bg-navbar shadow-sm sticky-top">
	<div class="container">
		<a class="navbar-brand" href="{{ url('/') }}">
			{{ config('app.name', 'Laravel') }}
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navAppBlog"
			aria-controls="navAppBlog" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navAppBlog">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">
				@auth
				<li class="nav-item active">
					<a class="nav-link" href="{{ route('home') }}">Mi Home<span class="sr-only">(current)</span></a>
				</li>
				@endauth
				<li class="nav-item">
					<a class="nav-link" href="#">API</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false">
						Más Información
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Sobre Nosotros..</a>
						<a class="dropdown-item" href="{{ route('message.show') }}">Contáctanos</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
			</ul>


			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item">
						<a class="nav-link fg-navbar-color" href="{{ route('login') }}">{{ __('Login') }}</a>
					</li>
					@if (Route::has('register'))
					<li class="nav-item fg-navbar-color">
						<a class="nav-link " href="{{ route('register') }}">{{ __('Register') }}</a>
					</li>
					@endif
				@else
					<li class="nav-item dropdown no-arrow">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">
							<span class="mr-2 d-none d-lg-inline text-light small">{{ Auth::user()->name }}</span>
							@if(auth()->user()->profile->image)
							<img class="img-current_user" src="{{ asset('storage/'.Auth::user()->profile->image->ruta) }}"
								alt="">
							@endif
						</a>
						<!-- Dropdown - User Information -->
						<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
							@if (auth()->user()->is_admin())
							<a class="dropdown-item" href="{{ route('admin.dashboard') }}">
								Ir al Dashboard
							</a>
							@endif
							<a class="dropdown-item" href="{{ route('account.show',auth()->user()->profile) }}">
								<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
								Mi Perfil
							</a>
							<a class="dropdown-item" href="{{ route('account.edit',auth()->user()->profile) }}">
								<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
								Editar mi Perfil
							</a>
							<a class="dropdown-item" href="#">
								<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
								Activity Log
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal"
								onclick="event.preventDefault();document.getElementById('logout-form').submit();">
								<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
								{{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</div>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>