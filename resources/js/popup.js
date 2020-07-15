//Popups functions

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