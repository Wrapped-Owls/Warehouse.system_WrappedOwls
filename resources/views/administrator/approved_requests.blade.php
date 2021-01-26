@if((auth()->user()->access_level) >=2)
    @extends('layouts.app')

    @section('page-title', 'Solicitações')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p>
                @if(isset($requests) and count($requests) > 0)
                    <h1 align="center" class="page-header">Requests Warehouse_system</h1></p><br>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th>Return Date</th>
                                <th>Quantity</th>
                                <th>Item</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($requests as $request)
                                <tr>
                                    <td>{{$request->return_date}}</td>
                                    <td>{{$request->quantity}}</td>
                                    <td>{{$request->name}}</td>
                                    <td>{{$request->email}}</td>
                                    <td>
                                        <a href="{{route('release', $request->code_inout)}}" class="btn btn-success">Release</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h1>There are no Items to be removed</h1>
                @endif
                <p>

                @if(isset($notReceived) and count($notReceived) > 0)
                    <h1 align="center" class="page-header">Items not returned</h1></p><br>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th>Return Date</th>
                                <th>Quantity</th>
                                <th>Item</th>
                                <th>User</th>
                                <th>Amount Received</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($notReceived as $request)
                                <tr>
                                    <td>{{$request->return_date}}</td>
                                    <td>{{$request->quantity}}</td>
                                    <td>{{$request->name}}</td>
                                    <td>{{$request->email}}</td>
                                    <td>
                                        <form method="POST" action="{{route('receive', $request->code_inout)}}">
                                            @csrf
                                            <input type="number" min="0" max="{{ $request->quantity }}"
                                                   name="quantity_received">
                                            <input type="submit" value="To receive" class="btn btn-success">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
@else
    @include('partials._unauthorized_access')
@endif