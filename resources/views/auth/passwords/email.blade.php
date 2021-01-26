@extends('layouts.app')

@section('page-title', 'Recover Password')

@section('content-header')
    @include('partials._login_register')
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Recover Password Warehouse_system</h3>
                </div>
                <div class="card-body">
                    <form class="login form" method="POST" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><p align="center"><h4><i
                                                    class="fas fa-user"></i></h4></p></span>
                                </div>
                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ old('email') }}" required placeholder="Email address">

                                @if ($errors->has('email'))
                                    <script>
                                        bootbox.alert({
                                            message: "Unregistered user!",
                                            backdrop: true
                                        });
                                    </script>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn float-right login_btn">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
