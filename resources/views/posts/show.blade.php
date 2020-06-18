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
					<h4><a class="card-link" href="#">{{ $post->title }}</a></h4>
				</div>
				{{ $post->body }}
			</div>
			<div class="row small">
				@if ($post->user->id === auth()->user()->id)
					<div class="col border-0 card-footer bg-transparent text-left">
						<a href="{{ route('posts.edit',$post) }}" class="link-post">Editar mi Post</a>
					</div>
				@endif
				<div class="col border-0 card-footer bg-transparent text-right">
					Autor: <span class="card-link">{{ $post->user->name }}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="my-2">
			<button class="btn-sm btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseComment" aria-expanded="false" aria-controls="collapseComment">
				Commentar
			</button>
		</div>
		<div class="collapse" id="collapseComment">
			<div class="card card-body border-0">
				<form method="POST" action="{{ route('posts.comments.store', $post) }}">
					@csrf
					<div class="form-group">
						<label for="body" class="form-label">Escribe tu comentario</label>
						<textarea name="body" class="sm form-control"></textarea>
						@error('body')<p><small class="text-danger text-bold">{{ $message }}</small></p>@enderror
					</div>
					<input type="submit" class="btn-sm btn btn-success" value="Publicar mi comentario">
				</form>
			</div>
		</div>
		<div class="container my-4">
			<h4 class="text-info">Comentarios</h4>
			@forelse ($post->comments as $comment)
				<div class="media">
				  <img src="{{ asset('storage/' .  $comment->user->profile->image->ruta) }}" class="img-comment-user mr-3" alt="...">
				  <div class="media-body">
				    <b class="mt-0">{{ $comment->user->name }}</b>
				    <p class="text-info">{{ $comment->body }}</p>
				    @if ($comment->user->id === auth()->user()->id)
				    	<a href="{{ route('posts.comments.destroy',[$post->slug,$comment]) }}" class="small text-danger"
				    		onclick="event.preventDefault();document.getElementById('delete-comment-{{$comment->user->slug}}').submit();">Eliminar mi comentario</a>
				    	<form id="delete-comment-{{$comment->user->slug}}" method="POST" action="{{ route('posts.comments.destroy',[$post->slug,$comment])}}">
				    		@method('DELETE')
				    		@csrf
				    	</form>
				    @endif
				  </div>
				</div>
			@empty
				<p>Hasta el momento no tienes comentarios</p>
			@endforelse
		</div>
	</div>
</div>
@endsection
