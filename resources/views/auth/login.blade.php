@extends('layouts.app')

@section('page-title', 'Login')

@section('content-header')
    @include('partials._login_register')
@endsection

@section('content')
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Login SGDA</h3>
                </div>
                <div class="card-body">
                        <form class="login form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><p align="center"><h4><i class="fas fa-user"></i></h4></p></span>
                                </div>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" required autofocus placeholder="Endereço de E-mail">

                                @if ($errors->has('email'))
                                    <script>
                                    bootbox.alert({
                                        message: "E-mail ou senha inválidos!",
                                        backdrop: true
                                    });
                                    </script>
                                @endif
                            </div>
                        </div>

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><p align="center"><h4><i class="fas fa-key"></i></h4></p></span>
                                </div>
                                <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required
                                   placeholder="Senha">

                                @if ($errors->has('password'))
                                    <script>
                                    bootbox.alert({
                                        message: "E-mail ou senha inválidos!",
                                        backdrop: true
                                    });
                                    </script>
                                @endif
                            </div>  
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn float-right login_btn">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <a class="btn float-right login_btn" href="{{ route('password.request') }}">Recuperar senha</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
