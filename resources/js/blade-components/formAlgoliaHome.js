function formAlgoliaHome() {
    let form = document.getElementById("algoliaForm");

    // activate form submit w. validation
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        if (document.getElementById("inputAlgolia-search__latlong").value) {
            form.submit();
        } else {
            document
                .querySelector(".search-home__error")
                .classList.remove("no-display");
        }
    });
}

export default formAlgoliaHome;
