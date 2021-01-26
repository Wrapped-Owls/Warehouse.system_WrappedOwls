@if((Auth::user()->access_level) >2)

    @extends('layouts.app')

    @section('page-title', 'Relatórios')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p>
                <h1 align="center" class="page-header">Reports Warehouse_system</h1></p><br>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <th>{{$report->id}}</th>
                                <td>{{$report->created_at}}</td>
                                <td><a href="/download/{{$report->created_at}}" class="btn btn-success">Download</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="/admin/pdf" class="btn btn-success">Generate report</a>
                </div>
                {!! $reports->links() !!}

            </div>
        </div>
    </div>
    </div>


@endsection
@else
    @include('partials._unauthorized_access')
@endif
