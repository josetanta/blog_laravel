<h4 class="text-info">Comentarios</h4>
@forelse ($post->comments as $comment)
	<div class="media">
	  <img src="{{ asset('storage/' .  $comment->user->profile->image->ruta) }}" class="img-comment-user mr-3" alt="...">
	  <div class="media-body">
	    <b class="mt-0">{{ $comment->user->name }}</b>
	    <p>{{ $comment->body }}</p>
			@auth
				@if ($comment->user->id === auth()->user()->id)
		    	<a href="{{ route('posts.comments.destroy',[$post->slug,$comment]) }}" class="small text-danger"
		    		onclick="event.preventDefault();document.getElementById('delete-comment-{{$comment->user->slug}}').submit();">Eliminar mi comentario</a>
		    	<form id="delete-comment-{{$comment->user->slug}}" method="POST" action="{{ route('posts.comments.destroy',[$post->slug,$comment])}}">
		    		@method('DELETE')
		    		@csrf
		    	</form>
		    @endif
			@endauth
	  </div>
	</div>
@empty
	<p>Hasta este post no tiene Comentarios</p>
@endforelse