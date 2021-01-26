@if((auth()->user()->access_level) >= 2)
    @extends('layouts.app')

    @section('page-title', 'Products')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')


    <div class="container-fluid">
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p>
                <h1 align="center" class="page-header">Products Warehouse_system</h1></p><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Qr code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Amount ($)</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Details</th>
                            <th scope="col">Remove</th>
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
                                <td><a href="{{route('product.edit', $product->code_product)}}" class="btn btn-success">Edit</a>
                                </td>
                                <td><a href="{{route('product.detail', $product->code_product)}}"
                                       class="btn btn-success">Details</a></td>
                                <td><a href="{{route('product.remove', $product->code_product)}}"
                                       class="btn btn-danger">Remove</a></td>
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
