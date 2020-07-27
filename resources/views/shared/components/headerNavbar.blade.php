<div class="headerNavbar-page">
    @if (Route::has('login'))
    @auth
    <ul>
        <li>
            <a @if(preg_match( '/^(home|flats.index)$/', Route::currentRouteName() ))class="active" @endif
                href="{{ route('home') }}">Esplora
            </a>
        </li>
        <li>
            <a @if(preg_match( '/^admin.(home|flats.(show|edit)|sponsorships.create|statistics)$/', Route::currentRouteName() ))class="active" @endif
                href="{{ route('admin.home') }}">Profilo
            </a>
        </li>
        <li>
            <a @if (Route::currentRouteNamed('admin.flats.create')) class="active" @endif
                href="{{ route('admin.flats.create') }}">Registra appartamento
            </a>
        </li>
        <li>
            <a @if (Route::currentRouteNamed('admin.sponsorships.index')) class="active" @endif
                href="{{ route('admin.sponsorships.index') }}">Sponsorizzazioni
            </a>
        </li>
        <li>
            <a @if (Route::currentRouteNamed('admin.requests.index')) class="active" @endif
                href="{{ route('admin.requests.index') }}">Messaggi
            </a>
        </li>
        <li>
            <a @if (Route::currentRouteNamed('assistance')) class="active" @endif href="">Assistenza
            </a>
        </li>
        <li>
            <a class="logout-header-navbar" href="{{ route('logout') }}" onclick="event.preventDefault();
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
        <li><a href="{{route('wip')}}">Diventa un host</a></li>
        <li><a href="{{route('wip')}}">Assistenza</a></li>
        <li>
            <button id="login-button-headerNavbar-page" onclick="showPopUpLogin()">Accedi</button>
        </li>
        <li>
            <button id="register-button-headerNavbar-page" onclick="showPopUpRegister()">Registrati</button>
        </li>
    </ul>
    @endauth
    @endif
</div>
