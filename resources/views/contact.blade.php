@extends('layouts.base')

@section('content-base')
	<form class="form-group" style="width: 40rem" action="{{ route('message.send') }}" method="POST">
		@csrf
		<div class="form-group">
			<input type="text" value="{{ old('name') }}" name="name" class="form-control" placeholder="{{ __('Nombre')}}">
		</div>
		<div class="form-group">
			<input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Email">
		</div>
		<div class="form-group">
			<input type="text" value="{{ old('asunt') }}" name="asunt" class="form-control" placeholder="Asunto">
		</div>
		<div class="form-group">
			<textarea value="{{ old('message') }}" name="message" class="form-control" placeholder="Mensaje"></textarea>
		</div>
		<input type="submit" class="btn-sm btn btn-success" value="{{__('Send')}}">
	</form>
@endsection