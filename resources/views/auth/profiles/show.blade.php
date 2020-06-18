@extends('layouts.base')

@section('title','Mi Perfil')

@section('content-base')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8">
			<div class="card" style="width: 20rem;">
				@if ($profile->image)
				<img class="card-img-top" src="{{ asset('storage/'.$profile->image->ruta)}}">
				@endif
				<div class="card-body">
					<h5 class="card-title text-info">{{ $profile->user->name }}</h5>
					<p class="card-text small">{{ $profile->historial }}</p>
					<small class="card-text small">{{ $profile->direccion }}</small>
				</div>

				@auth
				@if (auth()->user()->id === $profile->user_id)
				<div class="btn-group-sm m-3">
					<a href="{{ route('auth.posts.create',Auth::user()->slug) }}"
						class="btn btn-outline-info small">Crear Post</a>
				</div>
				@endif
				@endauth
			</div>
		</div>
		<div class="col-md-4">
			<div class="list-group toggle">
				<button type="button" class="list-group-item list-group-item-action active">
					Cras justo odio
				</button>
				<button type="button" class="list-group-item list-group-item-action">Dapibus ac facilisis in</button>
				<button type="button" class="list-group-item list-group-item-action">Morbi leo risus</button>
				<button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
				<button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<h5 class="small">Post Publicados</h5>
	<div class="row">
		@forelse ($posts as $post)
		<div class="col-md-4">
			<div class="card shadow mb-4">
				<a href="#post-{{ $post->id }}" class="d-block card-header py-3" data-toggle="collapse" role="button"
					aria-expanded="true" aria-controls="post-{{ $post->id }}">
					<h6 class="m-0 font-weight-bold text-primary">{{ $post->title }}</h6>
				</a>
				<div class="collapse show" id="post-{{ $post->id }}">
					<div class="card-body">
						<p>{{ $post->body }}</p>
					</div>
				</div>
			</div>
		</div>

		@empty
		<p>No publico aun sus posts</p>
		@endforelse
	</div>
</div>


@endsection