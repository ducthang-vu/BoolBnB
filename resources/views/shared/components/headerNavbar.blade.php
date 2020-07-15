@if (Route::has('login'))
    @auth
        <ul>
            <li><a href=""><i class="fas fa-globe mr-5"></i><i class="fas fa-angle-down"></i></a></li>
            <li><a href="{{ route('admin.home') }}">Home</a></li>
            <li><a href="">Proponi un'esperienza</a></li>
            <li><a href="">Assistenza</a></li>
            <li class="li-button">
                <a class="" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </li>
        </ul>
    @else
        <ul>
            <li><a href=""><i class="fas fa-globe mr-5"></i><i class="fas fa-angle-down"></i></a></li>
            <li><a href="">Diventa un host</a></li>
            <li><a href="">Proponi un'esperienza</a></li>
            <li><a href="">Assistenza</a></li>
            <li><button id="login-button" onclick="showPopUpLogin()">Accedi</button></li>
            <li><button id="register-button" onclick="showPopUpRegister()">Registrati</button></li>
            <div id="login-popup-div" class="popup popup-animation" style="display:none">
                <form id="login-popup" class="popup-form" action="{{ route('login') }}" method="POST">
                    @include('auth.login')
                </form>
            </div>
            <div id="register-popup-div" class="popup popup-animation" style="display:none">                    
                <form id="register-popup" class="popup-form" action="{{ route('register') }}" method="POST">
                    @include('auth.register')
                </form>
            </div>
        </ul>
    @endauth   
@endif