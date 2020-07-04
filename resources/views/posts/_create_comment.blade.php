@auth
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
@endauth