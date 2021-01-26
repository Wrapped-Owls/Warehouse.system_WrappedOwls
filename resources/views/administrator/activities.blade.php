@if((Auth::user()->access_level) >=2)
    @extends('layouts.app')

    @section('page-title', 'Logs de atividade')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p>
                <h1 align="center" class="page-header">Activities Warehouse_System</h1></p><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Access Level</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <th scope="row">{{$activity->id}}</th>
                                <td>{{$activity->user["name"]}}</td>
                                <td>{{$activity->user["access_level"]}}</td>
                                <td>{{$activity->action}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@else
    @include('partials._unauthorized_access')
@endif
