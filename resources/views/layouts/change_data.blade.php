@extends('layouts.app')

@section('page-title', 'Perfil ')

@section('content-header')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utils.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
@endsection

@section('content')
    <div class="container container-fluid">
        <div class="row justify-content-center">
            @if(auth()->user()->access_level >= 1)
                @include('administrator.sidebar')
            @else
                @include('collaborator.sidebar')
            @endif
            <div class="container-contact100">
                <div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422"
                     data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

                <div class="wrap-contact100">
                    <form class="contact100-form validate-form" action="{{ route('changeData.store') }}" method="post">
                        @csrf
                        <span class="contact100-form-title">
                    Edit profile
                </span>

                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <input value={{$data['name']}} id="name" type="text"
                                   class="input100{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name"
                                   value="{{ old('name') }}" required autofocus placeholder="Full name">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                            <input value={{$data['email']}} id="email" type="email"
                                   class="input100{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   name="email" value="{{ old('email') }}" required placeholder="Email address">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                            <input id="password" type="password"
                                   class="input100{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                   required placeholder="Password">

                            @if ($errors->has('password'))
                                <script>
                                    bootbox.alert({
                                        message: "Passwords do not match!",
                                        backdrop: true
                                    });
                                </script>
                            @endif
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                            <input id="password-confirm" type="password" class="input100" name="password_confirmation"
                                   required placeholder="Confirm password">
                        </div>


                        <div class="container-contact100-form-btn">
                            <button type="submit" class="contact100-form-btn">
                                Edit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
