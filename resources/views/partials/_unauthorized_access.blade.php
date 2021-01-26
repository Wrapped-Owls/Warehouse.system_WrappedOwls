@extends('layouts.app')

@section('page-title', 'Acesso negado')

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
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}"">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
@endsection

@section('content')
    <div class="container container-fluid">
        <div class="row justify-content-center">
            <div class="container-contact100">
                <div class="wrap-contact100">
                    <form class="contact100-form validate-form" enctype="multipart/form-data"
                          action="{{ url('/home') }}">
                        @csrf
                        <h2 align="center"><span class="contact100-form-title">
                            Acesso negado
                        </span></h2>

                        <div>
                            <h2 align="center"><img class="img2" src="{{ asset('img/negado.png') }}"></h2>
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="container-contact100-form-btn">
                            <button type="submit" class="contact100-form-btn">
                                Voltar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
