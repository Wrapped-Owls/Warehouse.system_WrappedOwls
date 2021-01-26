@if((Auth::user()->access_level) >2)
    @extends('layouts.app')

    @section('page-title', 'Transfer Item')

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
                    <form class="contact100-form validate-form" method="POST"
                          action="{{ route('inout.transfer', $data['id']) }}">
                        @csrf
                        <span class="contact100-form-title">
                    Transfer Item
                </span>
                        <label for="code_area"><b>{{ __('Target area') }}</b></label>
                        <div class="wrap-input100 validate-input" data-validate="Name is required">
                            <select id="code_area" type="text"
                                    class="form-control{{ $errors->has('code_area') ? ' is-invalid' : '' }}"
                                    name="code_area" value="{{ $data['code_area']}}" required>
                                <option value="0">Select an area</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->code_area }}">{{ $area->name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('code_area'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code_area') }}</strong>
                                    </span>
                            @endif
                            <span class="focus-input100-1"></span>
                            <span class="focus-input100-2"></span>
                        </div>
                        <label for="total_inside"><b>{{ __('Amount') }}</b></label>
                        <div class="wrap-input100 validate-input" data-validate="Message is required">
                            <input id="total_inside" type="number"
                                   class="form-control{{ $errors->has('total_inside') ? ' is-invalid' : '' }}"
                                   name="total_inside" value="{{ $data['total_inside'] }}" required>

                            @if ($errors->has('total_inside'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('total_inside') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="container-contact100-form-btn">
                            <button type="submit" class="contact100-form-btn">
                                Transfer
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
