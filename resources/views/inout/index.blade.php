@extends('layouts.app')

@section('page-title', 'Item')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(auth()->user()->access_level >= 1)
                @include('administrator.sidebar')
            @else
                @include('collaborator.sidebar')
            @endif
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p>
                <h1 align="center" class="page-header">Items Warehouse_system</h1></p><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"> #</th>
                            <th scope="col"> Product</th>
                            <th scope="col"> Area</th>
                            @if (auth()->user()->access_level == 0)
                                <th scope="col"> Quantity to be ordered</th> </th>
                            @else
                                <th scope="col"> Quantity</th>
                            @endif
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
                                        <form method="POST" action="{{ route('inout.update', $item->code_item) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT')}}
                                            @csrf
                                            <input id="total_inside" type="number"
                                                   class="{{ $errors->has('total_inside') ? ' is-invalid' : '' }}"
                                                   name="total_inside" value="{{ $item->total_inside }}" required>

                                            @if ($errors->has('total_inside'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('total_inside') }}</strong>
                                            </span>
                                            @endif
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Update inventory') }}
                                            </button>
                                            <a href="{{route('inout.edit', $item->code_item)}}" class="btn btn-success">Transfer
                                            </a>
                                        </form>
                                    </td>
                                @else
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
