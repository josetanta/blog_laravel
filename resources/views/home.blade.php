@extends('layouts.base')

@section('content-base')
<div class="row">
	<div class="col-md-8">

		@forelse ($posts as $post)

		<div class="container-sm mb-4">
			<div class="card" style="width:35rem">

				@if ($post->image)
				<img class="card-img-top" src="{{ asset('storage/'.$post->image->ruta) }}" alt="Card image cap">
				@endif
				<div class="card-body">
					<div class="card-title">
						<h4><a class="card-link" href="{{ route('posts.show', $post) }}">{{ $post['title'] }}</a></h4>
					</div>
					{{ $post['body'] }}
				</div>
				<div class="row">
					<div class="col border-0 card-footer bg-transparent text-left">
						<div class="p-1 badge badge-info">Comentarios <span class="badge badge-light">{{ $post->comments->count() }}</span></div>
					</div>
					<div class="col border-0 card-footer bg-transparent text-right small">
						Autor: <a href="#" class="card-link">{{ $post->user->name }}</a>
						@if ($post->user->profile->image)
						<small>
							<img class="img-current_user" src="{{ asset('images/accounts/'.$post->user->profile->image->ruta) }}"
								alt="" width="15">
						</small>
						@endif
					</div>
				</div>
			</div>
		</div>

		@empty
		<p>No se entraron Post</p>
		@endforelse

	</div>

	@section('notices')
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
@show
@endsection