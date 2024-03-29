<div class="container-register">
    <div class="card-popup">

        <div class="card-header">{{ __('Registrati') }}
            <span onclick="closePopUpRegister()" class="close-popup-page popup-animation"><i
                    class="far fa-times-circle"></i></span>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="div-register-page pt-20">
                    <input id="name" type="text" class="form-control-register-page @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="NAME" autofocus>

                    @error('name')
                    <span class="invalid-feedback-register-page block" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                <div class="div-register-page">
                    <input id="surname" type="text"
                        class="form-control-register-page @error('surname') is-invalid @enderror" name="surname"
                        value="{{ old('surname') }}" required autocomplete="surname" placeholder="SURNAME" autofocus>

                    @error('surname')
                    <span class="invalid-feedback-register-page block" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                <Div class="div-register-page">
                    <input id="date_of_birth" type="date"
                        class="form-control-register-page @error('date_of_birth') is-invalid @enderror"
                        name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth"
                        autofocus>

                    @error('date_of_birth')
                    <span class="invalid-feedback-register-page block" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                <div class="div-register-page">
                    <input id="email" type="email"
                        class="form-control-register-page @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" placeholder="E-MAIL" required autocomplete="email">

                    @error("email")
                    <span class="invalid-feedback-register-page block" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                <div class="div-register-page">
                    <input id="password" type="password"
                        class="form-control-register-page @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password" placeholder="PASSWORD">

                    @error('password')
                    <span class="invalid-feedback-register-page block" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>


                <div class="div-register-page">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password" placeholder="CONFIRM PASSWORD">
                </div>

                <div class="div-register-page">
                    <button type="submit" class="btn-register-page">
                        {{ __('Registrati') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
