<div class="form-group">
	<input class="form-control @error('title') is-invalid @enderror" type="text" @if($edit) value="{{ old('title',$post->title) }}" @else value="{{ old('title') }}"@endif placeholder="Titulo" name="title" required>
	@error('title')
		<div class="invalid-feedback">
			{{ $errors->first('title') }}
		</div>
	@enderror
</div>
<div class="form-group">
	<textarea name="body" class="form-control @error('body') is-invalid @enderror" placeholder="Contenido de su Post" required>@if($edit){{ old('body',$post->body) }}@else{{ old('body') }}@endif</textarea>
	@error('body')
		<div class="invalid-feedback">
			{{ $message }}
		</div>
	@enderror
</div>
<div class="form-group small w-25">
	<small class="small">
		<input type="file" name="image" class="form-control-file" placeholder="Suba una imagen">
		@error('image')
			<div class="invalid-feedback">
				{{ $errors->first('image') }}
			</div>
		@enderror
	</small>
</div>
<div class="form-group">
	<input type="submit" value="{{ $name_action }}" class="btn btn-sm btn-primary">
</div>