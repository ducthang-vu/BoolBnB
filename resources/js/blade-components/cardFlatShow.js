function cardFlatShow() {
    function popupToggle() {
        document.getElementById('popup-delete').classList.toggle('d-flex')
        document.querySelector('.map-section').classList.toggle('no-display')
    }
    document.getElementById('btn-delete-big').addEventListener('click', popupToggle)
    document.getElementById('btn-delete-small').addEventListener('click', popupToggle)
    document.getElementById('btn-cancel').addEventListener('click', popupToggle)
}

export default cardFlatShow
