@extends('layouts.base')

@section('content-base')
	<div class="row">
		<div class="col-md-8">
			<form action="{{ route('posts.update', $post) }}" method="POST" class="form-group" enctype="multipart/form-data">
				@method('PUT')
				@csrf
				@include('posts._form',['name_action' => 'Actualizar mi Post','edit' => true])
			</form>
		</div>
	</div>
@endsection