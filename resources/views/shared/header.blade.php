<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BoolBnB</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <nav class="navbar main-content mt-20">
            <a id="logo" href="{{route ('home')}}" class=""><i class="fab fa-airbnb mr-5"></i><span>boolbnb</span></a>
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
                    </ul>
                    <div id="login-popup-div" class="popup popup-animation" style="display:none">
                        <span onclick="closePopUpLogin()" class="close popup-animation"><i class="fas fa-times"></i></span>
                        <form id="login-popup" class="popup-form" action="{{ route('login') }}" method="POST">
                            @include('auth.login')
                        </form>
                    </div>
                    <div id="register-popup-div" class="popup popup-animation" style="display:none">
                        <span onclick="closePopUpRegister()" class="close popup-animation"><i class="fas fa-times"></i></span>                    
                        <form id="register-popup" class="popup-form" action="{{ route('register') }}" method="POST">
                            @include('auth.register')
                        </form>
                    </div>
                @endauth   
            @endif
        </nav>
    </header>