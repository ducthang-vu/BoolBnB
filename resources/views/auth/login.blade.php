<div class="container-login">
    <div class="card-popup">

        <div class="card-header">{{ __('Login') }}
            <span onclick="closePopUpLogin()" class="close-popup-page popup-animation"><i
                    class="far fa-times-circle"></i></span>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="div-container-login-page pb-5">
                    <label for="email" class="label-login-page">{{ __('E-Mail Address') }}</label>

                    <div class="div-login-page">
                        <input id="email-login" type="email"
                            class="form-control-login-page @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback-login-page block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="div-container-login-page pb-5">
                    <label for="password" class="label-login-page">{{ __('Password') }}</label>

                    <div class="div-login-page">
                        <input id="password-login" type="password"
                            class="form-control-login-page @error('password') is-invalid @enderror" name="password"
                            required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback-login-page block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="div-container-login-page pb-5 pt-10">
                    <div class="div-login-page">
                        <div class="form-check-login-page">
                            <input class="form-check-input-login-page" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label-login-page" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="div-container-login-page">
                    <div class="div-login-page">
                        <button type="submit" class="btn-login-page mb-10">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                        <a class="btn-forgot-login-page" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="error-message message-animation">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif