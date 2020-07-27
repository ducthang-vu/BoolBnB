<div class="footer-container">
    <footer class="main-footer">
        <nav class="nav-footer mb-10 pt-20">
            <div class="footer-column mb-10">
                <div class="footer-title">INFORMAZIONI</div>
                <ul>
                    <li><a href="{{route ('wip')}}">Come funziona Boolbnb</a></li>
                    <li><a href="{{route ('wip')}}">Diversità e appartenenza</a></li>
                    <li><a href="{{route ('wip')}}">Accessibilità</a></li>
                    <li><a href="{{route ('wip')}}">Affidabilità e sicurezza</a></li>
                    <li><a href="{{route ('wip')}}">Boolbnb Citizen</a></li>
                    <li><a href="{{route ('wip')}}">Olimpiadi</a></li>
                    <li><a href="{{route ('wip')}}">Newsroom</a></li>
                </ul>
            </div>
            <div class="footer-column mb-20">
                <div class="footer-title">COMMUNITY</div>
                <ul>
                    <li><a href="">Boolbnb Magazine</a></li>
                    <li><a href="">Boolbnb Associates</a></li>
                    <li><a href="">Boolbnb for Work</a></li>
                    <li><a href="">Invita degli amici</a></li>
                    <li><a href="">Opportunità di lavoro</a></li>
                </ul>
            </div>
            <div class="footer-column mb-20">
                <div class="footer-title">OSPITA</div>
                <ul>
                    <li><a href="">Diventa un host</a></li>
                    <li><a href="">Offri un'esperienza online</a></li>
                    <li><a href="">Messaggio dal CEO Paolo Duzioni</a></li>
                    <li><a href="">Affittare responsabilmente</a></li>
                    <li><a href="">Open Homes</a></li>
                    <li><a href="">Centro risorse</a></li>
                    <li><a href="">Community Center</a></li>
                </ul>
            </div>
            <div class="footer-column mb-20">
                <div class="footer-title">ASSISTENZA</div>
                <ul>
                    <li><a href="">Aggiornamenti sulla pandemia di COVID-19</a></li>
                    <li><a href="">Centro Assistenza</a></li>
                    <li><a href="">Opzioni di cancellazione</a></li>
                    <li><a href="">Servizio di assistenza di quartiere</a></li>
                </ul>
            </div>
        </nav>
        <nav class="nav-footer mt-20">
            <div class="footer-column pt-20 pb-20">
                <ul>
                    <li class="footer-title">© 2020 boolbnb, Inc. All rights reserved</li>
                    <li><a href="">Privacy</a></li>
                    <li><a href="">Termini</a></li>
                    <li><a href="">Mappa del sito</a></li>
                    <li><a href="">Dettagli dell'azienda</a></li>
                </ul>
            </div>
            <div class="footer-column pt-20 pb-20">
                <ul class="inline">
                    <li class="mr-20"><a href=""><i class="fas fa-globe"></i>Italiano (IT)</a></li>
                    <li class="mr-30"><a href=""><i class="fas fa-euro-sign"></i>EUR</a></li>
                </ul>
                <ul class="inline">
                    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                    <li><a href=""><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </nav>
    </footer>
</div>



{{-- JS --}}
<script src="{{ asset('js/app.js') }}"></script>
<script>
    //Popups functions

function showPopUpLogin() {
    var popupShow = document.getElementById('login-popup-div');
    var wrapper = document.querySelector('body .popup-wrapper-header');
    popupShow.style.display = 'block';
    wrapper.style.display = 'block';
}
function showPopUpRegister() {
    var popupShow = document.getElementById('register-popup-div');
    var wrapper = document.querySelector('body .popup-wrapper-header');
    popupShow.style.display = 'block';
    wrapper.style.display = 'block';
}
function closePopUpLogin() {
    var popupClose = document.getElementById('login-popup-div');
    var wrapper = document.querySelector('body .popup-wrapper-header');
    popupClose.style.display = 'none';
    wrapper.style.display = 'none';
}
function closePopUpRegister() {
    var popupClose = document.getElementById('register-popup-div');
    var wrapper = document.querySelector('body .popup-wrapper-header');
    popupClose.style.display = 'none';
    wrapper.style.display = 'none';
}

@php if (in_array('These credentials do not match our records.', $errors->all()))
    echo 'showPopUpLogin()';
    if (in_array('The email has already been taken.', $errors->all()))
    echo 'showPopUpRegister()';
@endphp

</script>