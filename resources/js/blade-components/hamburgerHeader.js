function hamburgerHeader() {
    let mobileNavbar = document.getElementById("id-mobile-navbar-header-page");

    let isMenuOpen = false
    let btnHamburger = document.getElementById('hamburger-btn');

    var btnLogin = document.querySelector('.hamburger-header-page #login-button-headerNavbar-page');

    var btnRegister = document.querySelector('.hamburger-header-page #register-button-headerNavbar-page');

    btnHamburger.addEventListener('click', function() {
        mobileNavbar.classList.toggle('show');
    });

    try {
        btnLogin.addEventListener('click', function() {
            if (mobileNavbar.classList.contains('show')) {
                mobileNavbar.classList.remove('show');
            }
        });

        btnRegister.addEventListener('click', function() {
            if (mobileNavbar.classList.contains('show')) {
                mobileNavbar.classList.remove('show');
            }
        });
    } catch {}  //do nothing
}

export default hamburgerHeader;
