@extends('admin.dashboard.base')

@section('title','Posts Registrados')

@section('side-bar')
@include('admin.dashboard.partial._sidebar')
@endsection

@section('content-fluid')
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Posts Registrados</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Autor</th>
							<th>Post</th>
							<th>Comentario</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Autor</th>
							<th>Post</th>
							<th>Comentario</th>
						</tr>
					</tfoot>
					<tbody>
					@forelse ($comments as $comment)
							<tr>
								<td>{{ $comment->id }}</td>
								<td><a href="{{ route('admin.profile.show', $comment->user->profile ) }}">{{ $comment->user->name }}</a></td>
								<td><a href="{{ route('admin.posts.show', $comment->post) }}">{{ $comment->post->title }}</a></td>
								<td>{{ $comment->body }}</td>
							</tr>
						@empty
							<p>Aun no hay comentarios</p>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection</h1>