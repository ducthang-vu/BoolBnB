@extends('layouts.main')

@section('page-content')
<div class="container-lostPassword-page">
    <div class="card-lostPassword-page">
        <div class="card-header-lostPassword-page">{{ __('Modifica la Password') }}</div>

        <div class="card-body-lostPassword-page">
            @if (session('status'))
            <div class="" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-lostPassword-page">
                    <label for="email"
                        class="">{{ __('Indirizzo E-mail') }}</label>

                    <div class="input-div-lostPassword-page">
                        <input id="email" type="email" class="form-control block @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="block">
                    <button type="submit" class="btn-login-page block">
                        {{ __('Invia il reset della password') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection