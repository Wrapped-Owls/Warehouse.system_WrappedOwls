@if((Auth::user()->access_level) >=2)
    @extends('layouts.app')

    @section('page-title', 'Register Product')

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
                <div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422"
                     data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

                <div class="wrap-contact100">
                    <form class="contact100-form validate-form" enctype="multipart/form-data" method="POST"
                          action="{{ action('App\Http\Controllers\ProductController@store') }}"
                          aria-label="{{ __('Register Product') }}">
                        @csrf
                        <span class="contact100-form-title">Register Product</span>

                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <input id="name" type="text"
                                   class="input100{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                   name="name" value="{{ old('name') }}" required autofocus
                                   placeholder="Product's name">

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                    <textarea id="material_description"
                              class="input100{{ $errors->has('material_description') ? ' is-invalid' : '' }}"
                              name="material_description" value="{{ old('material_description') }}"
                              required placeholder="Description"></textarea>
                            @if ($errors->has('material_description'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('material_description') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <input id="price" type="number" step="0.01"
                                   class="input100{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                   name="price" value="{{ old('price') }}" required autofocus placeholder="Price">

                            @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <label for="product_image" class="input100"><h5>Product Image</h5></label>

                        <div class="wrap-input100 validate-input" data-validate="Name is required">

                            <input id="name" type="file"
                                   data-input="false" id="product_image" name="product_image" required autofocus>

                            @if ($errors->has('product_image'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product_image') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>

                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100{{ $errors->has('disposable') ? ' is-invalid' : '' }}"
                                   name="disposable" value="true" id="disposable" type="checkbox">
                            <label class="label-checkbox100" for="disposable">
                                Non-returnable
                            </label>
                        </div>

                        <div class="container-contact100-form-btn">
                            <button type="submit" class="contact100-form-btn">
                                Register
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
