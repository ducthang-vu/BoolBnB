// Show message in request index page
function showRequestMessage() {
    let messageHandler = document.querySelectorAll(".request-message-handler");

    messageHandler.forEach(element => {
        element.addEventListener("click", function() {
            let message = this.querySelector(".request-message");
            let controls = this.querySelectorAll("h4");
            controls.forEach(element => {
                element.classList.toggle("active");
            });
            message.classList.toggle("active");
        });
    });
}

export default showRequestMessage;
