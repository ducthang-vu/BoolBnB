<div class="formAlgoliaHome-page">
    <div class="search-home d-flex">
        <form action=" {{ route('flats.index') }}" method="GET" id="algoliaForm">
            @csrf
            @method('GET')
            @include('shared.components.inputAlgolia')
            <input type="submit" value="Cerca" class="btn-search" id="search-home__submit-btn">
        </form>

        <div class="search-home__error no-display">Inserisci un indirizzo valido</div>
    </div>
</div>