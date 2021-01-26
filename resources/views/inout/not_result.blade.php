@if((auth()->user()->access_level) >= 2)

    @extends('layouts.app')

    @section('page-title', 'Search result')

@section('content-header')
    <link href="{{ asset('css/administrator_dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/utils.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(auth()->user()->access_level >= 1)
                @include('administrator.sidebar')
            @else
                @include('collaborator.sidebar')
            @endif
            <div class="container container-fluid">
                <div class="row justify-content-center">
                    <div class="container-contact100">
                        <div class="wrap-contact100">
                            <form class="contact100-form validate-form" enctype="multipart/form-data"
                                  action="{{ url('/home') }}">
                                @csrf
                                <h2 align="center"><span class="contact100-form-title">
                                    Result not found
                                </span></h2>

                                <div>
                                    <h2 align="center"><img class="img2" src="{{ asset('img/404.png') }}"></h2>
                                    <span class="focus-input100-1"></span>
                                    <span class="focus-input100-2"></span>
                                </div>

                                <div class="container-contact100-form-btn">
                                    <button type="submit" class="contact100-form-btn">
                                        Back
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@else
    @include('partials._unauthorized_access')
@endif
