@extends('layouts.app')

@section('page-title', 'Colaborador')
 
@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('collaborator.sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p><h1 align="center" class="page-header">Colaborador SGDA</h1></p><br>
                <h2 class="sub-header">Solicitações de outras áreas</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Data do pedido</th>
                            <th>Quantidade</th>
                            <th>Item</th>
                            <th>Usuário</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(isset($requests))
                        @foreach($requests as $request)
                            <tr>
                                <td>{{$request->code_request}}</td>
                                <td>{{$request->request_datetime}}</td>
                                <td>{{$request->quantity}}</td>
                                <td>{{$request->product_name}}</td>
                                <td>{{$request->user_name}}</td>
                                <td><a href="{{route('approve', $request->code_request)}}" class="btn btn-success">Aprovar</a></td>
                                <td><a href="{{route('refuse', $request->code_request)}}" class="btn btn-danger">Recusar</a></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
