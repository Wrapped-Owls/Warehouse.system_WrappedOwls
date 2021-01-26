@extends('layouts.app')

@section('page-title', 'Detalhes do produto')

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
				<div class="contact100-map" id="google_map" data-map-x="40.722047" data-map-y="-73.986422" data-pin="images/icons/map-marker.png" data-scrollwhell="0" data-draggable="1"></div>

				<div class="wrap-contact100">
					<form class="contact100-form validate-form" action="{{ route('product.detail',$data['id']) }}">
						@csrf
						<span class="contact100-form-title">
                    Detalhes do produto
                </span>


						<div class="wrap-input100 validate-input" data-validate="Name is required">
							@if(!$data['image'])
								<p>O produto nao possui imagem associada</p>
							@else
								<img src="{{$data['image']}}" class="input100" alt="Responsive image">
							@endif
							<span class="focus-input100-1"></span>
							<span class="focus-input100-2"></span>
						</div>
						<label for="price"><b>{{ __('Nome') }}</b></label>
						<div class="wrap-input100 validate-input" data-validate="Name is required">
							<label id="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $data['name']}}" required autofocus>{{ $data['name']}}</label>

							@if ($errors->has('name'))
								<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
							@endif
							<span class="focus-input100-1"></span>
							<span class="focus-input100-2"></span>
						</div>
						<label for="price"><b>{{ __('Descrição') }}</b></label>
						<div class="wrap-input100 validate-input" data-validate="Message is required">
							<label id="material_description" type="text" class="{{ $errors->has('material_description') ? ' is-invalid' : '' }}" name="material_description" value="{{ $data['description']}}" required>{{ $data['description']}}</label>

							@if ($errors->has('material_description'))
								<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('material_description') }}</strong>
                                    </span>
							@endif
							<span class="focus-input100-1"></span>
							<span class="focus-input100-2"></span>
						</div>
						<label for="price"><b>{{ __('Preço (R$)') }}</b></label>
						<div class="wrap-input100 validate-input" data-validate="Name is required">
							<label id="price" type="number" class="{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ $data['price'] }}" required>{{ $data['price'] }}</label>

							@if ($errors->has('price'))
								<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
							@endif
							<span class="focus-input100-1"></span>
							<span class="focus-input100-2"></span>
						</div>
						<div class="row">
						<div class="col-md-6 container-contact100-form-btn">
							<a href="{{route('product.index')}}" class="contact100-form-btn">
								Voltar
							</a>
						</div>
							<div class="col-md-6 container-contact100-form-btn">
								<a href="{{route('baixarqr',$data['id'])}}" class="contact100-form-btn">
									Baixar QrCode
								</a>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
