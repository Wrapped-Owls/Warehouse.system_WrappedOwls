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
                <p><h1 align="center" class="page-header">Devoluções SGDA</h1></p><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th>Quantidade Retornada</th>
                            <th>Item</th>
                            <th>Usuário</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(isset($requests) and !empty($requests))
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{$request->return_date}}</td>
                                    <td>{{$request->quantity}}</td>
                                    <td>{{$request->name}}</td>
                                    <td>{{$request->email}}</td>
                                    <td>
                                        <a href="{{route('receive_item', $request->code_inout)}}" class="btn btn-success">Receber</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
@else
    @include('partials._unauthorized_access')
@endif