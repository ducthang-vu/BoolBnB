<div class="formAlgolia-page">
    <div class="search-home d-flex">
        <form action=" {{ route('flats.index') }}" method="GET" id="algoliaForm">
            @csrf
            @method('GET')
            @include('shared.components.inputAlgolia')
            <input type="submit" value="Cerca" class="btn-search" id="search-home__submit-btn">
        </form>

        <div class="search-home__error no-display">Inserisci un indirizzo valido</div>
        <button id="filter" class="btn btn-filter">Filtri</button>
    </div>


    <div class="search-home--two">
        @yield('formAlgoliaSupplement')
    </div>
</div>

<script>
    let form = document.getElementById('algoliaForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (document.getElementById('search-home__latlong').value) {
            form.submit();
        } else {
            document.querySelector('.search-home__error').classList.remove('no-display');
        }
    });
</script>