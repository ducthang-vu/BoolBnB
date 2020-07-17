<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BoolBnB</title>
    {{-- Leaflet Css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
</head>
<body>
    <div class="popup-wrapper-header">
    </div>
    <header class="main-header">
        <nav class="navbar-header-page main-content">
            <a class="logo-header-page" href="{{route ('home')}}"><i class="fab fa-airbnb mr-1"></i><span>boolbnb</span></a>
            <div class="big-navbar-header-page">
                @include ('shared.components.headerNavbar')
            </div>

            <div class="hamburger-header-page">
                <div class="menu-icon-header-page">
                    <button id="hamburger-btn"><i class="fas fa-bars"></i></button>
                </div>
                <div id="id-mobile-navbar-header-page" class="mobile-navbar-header-page">
                    <div class="emptydiv-header-page">&nbsp;</div>
                    @include ('shared.components.headerNavbar-mobile')
                </div>
            </div>
        </nav>
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
    </header>

