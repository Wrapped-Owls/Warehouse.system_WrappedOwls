@section('page-title', 'Solicitar Item')

<form method="POST" action="{{ action('ItemRequestController@store') }}" aria-label="{{ __('Solicitar Item') }}">
    @csrf
    <input id="code_item" type="hidden" class="form-control{{ $errors->has('code_item') ? ' is-invalid' : '' }}"
           name="code_item" value="{{ $data['code_item']}}" required>

    <div class="form-group row">
        <div class="col-md-4">
            <input id="total_request" type="number"
                   class="form-control{{ $errors->has('total_request') ? ' is-invalid' : '' }}" name="total_request"
                   value="{{ $data['total_inside'] }}" required>

            @if ($errors->has('total_request'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('total_request') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-3">
            <input id="return_date" type="date"
                   class="form-control{{ $errors->has('return_date') ? ' is-invalid' : '' }}" name="return_date"
                   value="{{ $data['total_inside'] }}" required>

            @if ($errors->has('return_date'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('return_date') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-4 offset-md-1">
            <button type="submit" class="btn btn-primary">
                {{ __('Solicitar Item') }}
            </button>
        </div>
    </div>
</form>