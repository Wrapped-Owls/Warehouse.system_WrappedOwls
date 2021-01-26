@extends('layouts.app')

@section('page-title', 'Edit area')

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
            @include('administrator.sidebar')
            <div class="container-contact100">

                <div class="wrap-contact100">
                    <form class="contact100-form validate-form" method="POST"
                          action="{{ route('area.update', $area->code_area) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT')}}
                        @csrf
                        <span class="contact100-form-title">
                    Edit area
                </span>

                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <input id="name" type="text"
                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                   placeholder="{{ $area->name }}">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                            <select id="responsible_name" type="text"
                                    class="form-control{{ $errors->has('responsible_name') ? ' is-invalid' : '' }}"
                                    name="responsible" required autofocus>
                                <option disabled selected>Select</option>
                                @foreach($collaborators as $collaborator)
                                    <option value="{{ $collaborator->code_user }}" <?php if($collaborator->code_user == $area->responsible)
										echo("selected"); ?>>{{ $collaborator->user->name }}</option>
                                @endforeach
                            </select>

                            @if (empty('responsible_name'))
                                <script>
                                    bootbox.alert({
                                        message: "Responsible not associated!",
                                        backdrop: true
                                    });
                                </script>
                            @endif

                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
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
