@if((Auth::user()->access_level) >=2)
    @extends('layouts.app')

    @section('page-title', 'Backups')

@section('content-header')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('administrator.sidebar')
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <p>
                <h1 align="center" class="page-header">Backup Warehouse_system</h1></p><br>
                <div class="row">
                    <div class="col-md-3">
                        <h2 class="page-header">Options</h2>
                    </div>
                    <div class="col-md-2">
                        <form method="POST" action="{{ route('backup.store') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Generate new Backup</button>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('backup.import') }}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                <div class="col-md-1"></div>
                                <label for="importar" class="btn btn-info">Import Backup</label>
                                <button id="importar" onclick="this.form.submit()" style="visibility:hidden;"></button>
                                <div class="col-md-1"></div>
                                <label for="backup_database" class="btn btn-success">Select file &#187;</label>
                                <input data-input="false" style="visibility:hidden;" id="backup_database"
                                       name="backup_database" type="file" required/>
                                <div class="col-md-1"></div>
                            </div>
                            @if ($errors->has('backup_database'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('backup_database') }}</strong>
                                </span>
                            @endif
                        </form>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($urls as $filename => $url)
                        <tr>
                            <td>{{ $filename }}</td>
                            <td><a class="btn btn-primary" href="{{ $url }}">Download</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@else
    @include('partials._unauthorized_access')
@endif