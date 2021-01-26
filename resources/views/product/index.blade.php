@if((auth()->user()->access_level) >= 2)
@extends('layouts.app')

@section('page-title', 'Produtos')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')


<div class="container-fluid">
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p><h1 align="center" class="page-header">Produtos SGDA</h1></p><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Código Qr</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Valor (R$)</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Remover</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <tr>
                        <th scope="row">{{$product->code_product}}</th>
                        <td>{!! QrCode::generate(route("main") . "/product/{$product->code_product}/detail"); !!}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->material_description}}</td>
                        <td>{{$product->item()->sum('total_inside')}}</td>
                        <td>{{$product->price}}</td>
                        <td><a href="{{route('product.edit', $product->code_product)}}" class="btn btn-success">Editar</a></td>
                        <td><a href="{{route('product.detail', $product->code_product)}}" class="btn btn-success">Detalhes</a></td>
                        <td><a href="{{route('product.remove', $product->code_product)}}" class="btn btn-danger">Remover</a></td> 
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                {!! $products->links() !!}
            </div>
        </div>
    </div>
@endsection
@else
    @include('partials._unauthorized_access')
@endif