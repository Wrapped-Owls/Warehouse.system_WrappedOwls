@extends('layouts.app')

@section('page-title', 'Administrador')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p>
                <h1 align="center" class="page-header">Administrator Warehouse_system</h1>
                <br>
                @if((auth()->user()->access_level) > 2)
                    <h2 class="sub-header">Pending Requests</h2>
                    <div class="table-responsive">
                        @if(isset($requests) and count($requests) > 0)
                            <table class="table table-striped">
                                <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Order date</th>
                                    <th>Quantity</th>
                                    <th>Item</th>
                                    <th>User</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($requests as $request)
                                    <tr>
                                        <td>{{$request->code_request}}</td>
                                        <td>{{$request->request_datetime}}</td>
                                        <td>{{$request->quantity}}</td>
                                        <td>{{$request->product_name}}</td>
                                        <td>{{$request->user_name}}</td>
                                        <td>
                                            <a href="{{route('approve', $request->code_request)}}"
                                               class="btn btn-success">Approve</a>
                                            <a href="{{route('refuse', $request->code_request)}}"
                                               class="btn btn-danger">Refuse</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <span>There are no pending requests</span>
                        @endif
                    </div>
                @endif
                @if((auth()->user()->access_level) >=2)
                    <h2 class="sub-header">Stopped Products</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($stationaryProducts))
                                @foreach($stationaryProducts as $product)
                                    <tr>
                                        <td>{{$product->code_product}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->material_description}}</td>
                                        <td>
                                            <a href="{{route('product.detail', $product->code_product)}}"
                                               class="btn btn-success">Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
