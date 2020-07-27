function cardFlatShow() {
    function popupToggle() {
        document.getElementById('popup-delete').classList.toggle('d-flex')
        document.querySelector('.map-section').classList.toggle('no-display')
    }
    if (document.querySelector('.options-big')) {
        document.getElementById('btn-delete-big').addEventListener('click', popupToggle)
    }

    if (document.querySelector('.options-small')) {
        document.getElementById('btn-delete-small').addEventListener('click', popupToggle)
    }

    if (document.querySelector('.popup-delete')) {
        document.getElementById('btn-cancel').addEventListener('click', popupToggle)
    }
    
}

export default cardFlatShow
