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
            <li><a href="{{ route('login') }}">Accedi</a></li>
            <li class="li-button"><a href="{{ route('register') }}">Registrati</a></li>
        </ul>
    @endauth   
@endif