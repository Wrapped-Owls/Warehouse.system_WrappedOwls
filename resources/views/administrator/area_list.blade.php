@extends('layouts.app')

@section('page-title', 'Áreas')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p>
                <h1 align="center" class="page-header">Áreas SGDA</h1></p><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Remover</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <th scope="row">{{$area->code_area}}</th>
                                <td>{{$area->name}}</td>
                                <td><a href="{{ route('area.edit', $area->code_area) }}" class="btn btn-success">Editar</a></td>
                                <td><a href="{{ route('area.remove', $area->code_area) }}" class="btn btn-danger">Remover</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $areas->links() !!}
            </div>
        </div>
    </div>
@endsection
