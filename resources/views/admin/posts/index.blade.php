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
							<th>Titulo</th>
							<th>Descripción</th>
							<th>Autor</th>
							<th>Fecha de Creación</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Titulo</th>
							<th>Descripción</th>
							<th>Autor</th>
							<th>Fecha de Creación</th>
						</tr>
					</tfoot>
					<tbody>
						@forelse ($posts as $post)
						<tr id="{{ $post->slug }}">
							<td>{{ $post->id }}</td>
							<td><a href="{{ route('admin.posts.show',$post) }}">{{ $post->title }}</a></td>
							<td>{{ $post->body }}</td>
							<td>{{ $post->user->name }} <br><a href="{{ route('admin.profile.show',$post->user->profile->id) }}" class="small text-info">{{ $post->user->email }}</a></td>
							<td>{{ $post->created_at }}</td>
							<td class="small" colspan="2">
								<a class="btn-sm btn-outline-warning " href="#">Prohibir Post</a>
							</td>
						</tr>
						@empty
						<h5>Aun no Hay Posts Registrado</h5>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection</h1>