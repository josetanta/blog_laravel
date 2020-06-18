@extends('admin.dashboard.base')

@section('title','Usuarios Registrados')

@section('side-bar')
@include('admin.dashboard.partial._sidebar')
@endsection

@section('content-fluid')
<div class="container-fluid text-sm">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Usuarios Registrados</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Rol</th>
							<th>Foto</th>
							<th>Fecha de Resgistro</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>Email</th>
							<th>Rol</th>
							<th>Foto</th>
							<th>Fecha de Resgistro</th>
						</tr>
					</tfoot>
					<tbody>
						@forelse ($users as $user)
						<tr>
							{{ $user->roles[0]->name }}
							<td>{{ $user->id }}</td>
							<td>{{ $user->name }}</td>
							<td><a href="{{ route('admin.profile.show',$user->profile) }}">{{ $user->email }}</a></td>
							<td>{{ $user->roles[0]->name }}</td>
							<td><a href="{{ asset('storage/'.$user->profile->image->ruta) }}">{{$user->profile->image->ruta}}</a></td>
							<td>{{ $user->created_at }}</td>
						</tr>
						@empty
						<h5>Aun no Hay Usuarios Registrado</h5>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection