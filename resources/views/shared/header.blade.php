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
    <div id="popup-wrapper">
    </div>
    <header class="main-header">
        <nav class="navbar">
            <a id="logo" href="{{route ('home')}}" class=""><i class="fab fa-airbnb mr-5"></i><span>boolbnb</span></a>
            <div class="big-navbar">
                @include ('shared.components.headerNavbar')
            </div>
            
            <div class="hamburger">
                <div class="menu-icon">
                    <button id="hamburger-btn"><i class="fas fa-bars"></i></button>
                </div>
                <div id="mobile-navbar" class="mobile-navbar">
                    <div class="mobile-navbar-header">&nbsp;</div>
                    @include ('shared.components.headerNavbar')
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

