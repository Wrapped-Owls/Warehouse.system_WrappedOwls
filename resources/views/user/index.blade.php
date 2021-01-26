@if((auth()->user()->access_level) ==3)
	@extends('layouts.app')

	@section('page-title', 'Usuarios')

@section('content-header')
	<link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')


	<div class="container-fluid">
		<div class="row">
			@include('administrator.sidebar')
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<p>
				<h1 align="center" class="page-header">Usuários</h1></p><br>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead class="thead-light">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nome</th>
							<th scope="col">Email</th>
							<th scope="col">Nível de Acesso</th>
							<th scope="col">Ação</th>
							<th scope="col"></th>
						</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							<tr>
								<th scope="row">{{$user->id}}</th>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->access_level}}</td>
								<td>
									<a href="{{route('user.edit', $user->id)}}" class="btn btn-success">Editar</a>
								</td>
								<td>
									<form method="POST" action="{{route('user.destroy', $user->id)}}">
										@csrf
										{!! method_field('delete') !!}
										<input type="submit" class="btn btn-danger" value="Suspender">
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				{!! $users->links() !!}
				<h1 align="center" class="page-header">Usuários Banidos</h1></p><br>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead class="thead-light">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Nome</th>
							<th scope="col">Email</th>
							<th scope="col">Nivel de Acesso</th>
							<th scope="col">Ação</th>

						</tr>
						</thead>
						<tbody>
						@foreach($suspended as $user)
							<tr>
								<th scope="row">{{$user->id}}</th>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->access_level}}</td>
								<td>
									<form method="POST" action="{{route('restoreUser', $user->id)}}">
										@csrf
										<input type="submit" class="btn btn-primary" value="Restaurar">
									</form>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				{!! $suspended->links() !!}
			</div>
		</div>
	</div>
@endsection
@else
	@include('partials._unauthorized_access')
@endif