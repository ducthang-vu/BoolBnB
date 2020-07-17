<div class="headerNavbar-page">
    @if (Route::has('login'))
        @auth
            <ul>
                <li><a href=""><i class="fas fa-globe mr-5"></i><i class="fas fa-angle-down"></i></a></li>
                <li><a href="{{ route('admin.home') }}">Home</a></li>
                <li><a href="{{ route('admin.flats.create') }}">Registra Appartamento</a></li>
                <li><a href="{{ route('admin.sponsorships.index') }}">Sponsorizzazioni</a></li>
                <li><a href="">Assistenza</a></li>
                <li>
                    <a class="" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </li>
            </ul>
        @else
            <ul>
                <li><a href=""><i class="fas fa-globe mr-5"></i><i class="fas fa-angle-down"></i></a></li>
                <li><a href="">Diventa un host</a></li>
                <li><a href="">Assistenza</a></li>
                <li><button id="login-button-headerNavbar-page" onclick="showPopUpLogin()">Accedi</button></li>
                <li><button id="register-button-headerNavbar-page" onclick="showPopUpRegister()">Registrati</button></li> 
            </ul>
        @endauth
    @endif
</div>

