// Show message in request index page
function showRequestMessage() {
    const cards = document.querySelectorAll(".request-card");
    cards.forEach(card => {
        card.addEventListener("click", function() {
            cards.forEach(card => {
                card.classList.remove("active");
            });
            card.classList.add("active");
        });
    });
}

export default showRequestMessage;
