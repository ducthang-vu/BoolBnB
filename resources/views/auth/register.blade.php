<div class="container-register">
    <div class="card-popup">
    
        <div class="card-header">{{ __('Registrati') }}
            <span onclick="closePopUpRegister()" class="close-popup-page popup-animation"><i class="far fa-times-circle"></i></span>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="div-register-page pb-10 pt-20">
                    <input id="name" type="text" class="form-control-register-page @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="NAME" autofocus>

                    @error('name')
                        <span class="invalid-feedback-register-page" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="div-register-page pb-10">
                    <input id="surname" type="text" class="form-control-register-page @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" placeholder="SURNAME" autofocus>

                    @error('surname')
                        <span class="invalid-feedback-register-page" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <Div class="div-register-page pb-10">
                    <input id="date_of_birth" type="text" class="form-control-register-page @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" placeholder="DATE OF BIRTHDAY YYYY-MM-DD" autofocus>

                    @error('date_of_birth')
                        <span class="invalid-feedback-register-page" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="div-register-page pb-10">
                    <input id="email" type=""email" class="form-control-register-page @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-MAIL" required autocomplete="email">

                    @error('"email')
                        <span class="invalid-feedback-register-page" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="div-register-page pb-10">
                    <input id="password" type="password" class="form-control-register-page @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="PASSWORD">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                <div class="div-register-page pb-10">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="CONFIRM PASSWORD">
                </div>

                <div class="div-register-page pb-10">
                    <button type="submit" class="btn-register-page">
                        {{ __('Registrati') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

