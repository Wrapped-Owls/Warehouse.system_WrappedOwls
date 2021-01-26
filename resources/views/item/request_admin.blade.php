@extends('layouts.app')

@section('page-title', 'Item')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(auth()->user()->access_level > 1)
                @include('administrator.sidebar')
            @endif
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p>
                <h1 align="center" class="page-header">Items Warehouse_system</h1></p><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Area</th>
                            <th scope="col">Quantity to be ordered</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <th scope="row">{{$item->code_item}}</th>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->area_name}}</td>
                                @if(auth()->user()->access_level > 1)
                                    <td>
                                        @include('item.request', ['data' => $item])
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $items->links() !!}
            </div>
        </div>
    </div>
@endsection
