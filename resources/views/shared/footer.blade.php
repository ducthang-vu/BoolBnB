<footer class="main-footer">
    <nav class="nav-footer mb-10 pt-20">
        <div class="footer-column">
            <div class="footer-title">INFORMAZIONI</div>
            <ul>
                <li><a href="">Come funziona Airbnb</a></li>
                <li><a href="">Diversità e appartenenza</a></li>
                <li><a href="">Accessibilità</a></li>
                <li><a href="">Affidabilità e sicurezza</a></li>
                <li><a href="">Airbnb Citizen</a></li>
                <li><a href="">Olimpiadi</a></li>
                <li><a href="">Newsroom</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <div class="footer-title">COMMUNITY</div>
            <ul>
                <li><a href="">Airbnb Magazine</a></li>
                <li><a href="">Airbnb Associates</a></li>
                <li><a href="">Airbnb for Work</a></li>
                <li><a href="">Invita degli amici</a></li>
                <li><a href="">Opportunità di lavoro</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <div class="footer-title">OSPITA</div>
            <ul>
                <li><a href="">Diventa un host</a></li>
                <li><a href="">Offri un'esperienza online</a></li>
                <li><a href="">Messaggio dal CEO Brian Chesky</a></li>
                <li><a href="">Affittare responsabilmente</a></li>
                <li><a href="">Open Homes</a></li>
                <li><a href="">Centro risorse</a></li>
                <li><a href="">Community Center</a></li>
            </ul>
        </div>
        <div class="footer-column">
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

{{-- JS --}}
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function showPopUpLogin() {
        var popupShow = document.getElementById('login-popup-div');
        popupShow.style.display ='block';
        // popupClose.classList.add('prova');
    }
    function showPopUpRegister() {
        var popupShow = document.getElementById('register-popup-div');
        popupShow.style.display ='block';
    }
    function closePopUpLogin() {
        var popupClose = document.getElementById('login-popup-div');
        popupClose.style.display ='none';
    }
    function closePopUpRegister() {
        var popupClose = document.getElementById('register-popup-div');
        popupClose.style.display ='none';
    }
</script>