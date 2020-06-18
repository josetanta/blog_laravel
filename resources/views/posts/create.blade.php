@extends('layouts.base')

@section('title','Crear Post')

@section('content-base')
<div class="row">
	<div class="col-md-8">
		<div class="frames-container">
			<form action="{{ route('auth.posts.store',auth()->user()->slug) }}" method="POST" class="form-group" enctype="multipart/form-data">
				@csrf
				@include('posts._form', ['name_action' => 'Crear Post', 'edit' => false])
			</form>
		</div>
	</div>
</div>
@endsection
