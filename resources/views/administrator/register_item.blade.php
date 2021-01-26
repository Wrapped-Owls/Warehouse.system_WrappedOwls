@if((Auth::user()->access_level) >=2)
    @extends('layouts.app')

    @section('page-title', 'Associar produto')

@section('content-header')
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utils.css') }}" rel="stylesheet">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}"">
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
                          action="{{ action('ItemController@store') }}">
                        @csrf
                        <span class="contact100-form-title">
                    Associar produto
                </span>
                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <select id="product" type="text"
                                    class="form-control{{ $errors->has('product') ? ' is-invalid' : '' }}"
                                    name="product" value="{{ old('product') }}" required autofocus>
                                <option value="0" disabled selected>Selecione um produto</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->code_product }}">{{ $product->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('product'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                            <select id="area" type="text"
                                    class="form-control{{ $errors->has('area') ? ' is-invalid' : '' }}" name="area"
                                    value="{{ old('area') }}" required>
                                <option disabled selected>Selecione uma área</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->code_area }}">{{ $area->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('area'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                            <input id="total_inside" type="number" min="1"
                                   class="form-control{{ $errors->has('total_inside') ? ' is-invalid' : '' }}"
                                   name="total_inside" value="{{ old('total_inside') }}" required
                                   placeholder="Quantidade">

                            @if ($errors->has('total_inside'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_inside') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1">

                            </span>
                            <span class="focus-input100-2"></span>
                        </div>
                        @if($error != null)
                            <strong>{{ $error }}</strong>
                        @endif
                        <div class="container-contact100-form-btn">
                            <button type="submit" class="contact100-form-btn">
                                Associar
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