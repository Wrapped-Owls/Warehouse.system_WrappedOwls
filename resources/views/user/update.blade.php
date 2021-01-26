@if((Auth::user()->access_level) ==3)

    @extends('layouts.app')

    @section('page-title', 'Editar usuario')

@section('content-header')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utils.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}"">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}"">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}"">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}"">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}"">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}"">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
@endsection

@section('content')
    <div class="container container-fluid">
        <div class="row justify-content-center">
            @include('administrator.sidebar')
            <div class="container-contact100">

                <div class="wrap-contact100">
                    <form class="contact100-form validate-form" method="POST" action="{{ route('user.update',$user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT')}}
                        @csrf
                        <span class="contact100-form-title">
                    Editar usuario
                </span>

                        <label for="name" class="input100"><h5>Nome</h5></label>

                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <input id="name" type="text" class="input100{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name}}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>
                        <label for="name" class="input100"><h5>Email</h5></label>

                        <div class="wrap-input100 validate-input" data-validate="Email is required">
                            <input id="email" type="email" class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email}}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Access Level is required">
                            <table>
                                <tr><td><input id="accessLevel" {{$user->access_level == 0 ? 'checked' : ''}} type="radio" class="form-group" name="accessLevel" value="0"> 1 - Colaborador</td></tr>
                                <tr><td><input id="accessLevel" {{$user->access_level == 1 ? 'checked' : ''}} type="radio" class="form-group" name="accessLevel" value="1"> 2 - Docente Coordenador</td></tr>
                                <tr><td><input id="accessLevel" {{$user->access_level == 3 ? 'checked' : ''}} type="radio" class="form-group" name="accessLevel" value="3"> 3 - Administrador SGDA</td></tr><br>
                            </table>
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>






                        <div class="container-contact100-form-btn">
                            <button type="submit" class="contact100-form-btn">
                                Editar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@else
    @include('partials._unauthorized_access')
@endif