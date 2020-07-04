@extends('layouts.base')

@section('title',$post->title)

@section('content-base')
<div class="row">
	<div class="col-md-8">
		<div class="card" style="width:35rem">
			@if ($post->image)
				<img class="card-img-top" src="{{ asset('storage/'.$post->image->ruta) }}" alt="Card image cap">
			@endif
			<div class="card-body">
				<div class="card-title">
					<h4 class="text-info">{{ $post->title }}</h4>
				</div>
				{{ $post->body }}
			</div>
			<div class="row small">
				@auth
					@if ($post->user->id === auth()->user()->id)
						<div class="col border-0 card-footer bg-transparent text-left">
							<a href="{{ route('posts.edit',$post) }}" class="link-post">Editar mi Post</a>
						</div>
					@endif
				@endauth
				<div class="col border-0 card-footer bg-transparent text-right">
					Autor: <span class="card-link">{{ $post->user->name }}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		@include('posts._create_comment')
		<div class="container my-4">
			@include('posts._comments')
		</div>
	</div>
</div>
@endsection
