<form id="algoliaForm" class="formAlgoliaIndex-page d-flex">
    @csrf
    <div class="row pt-25 align-center">
        @include('shared.components.inputAlgolia')
        <input type="submit" value="Cerca" class="btn-search" id="search-home__submit-btn">
    </div>

    <div class="search-index__error no-visibility p-10 text-center">Inserisci un indirizzo valido</div>
    <button id="filter" type="button" class="btn btn-filter btn-link mb-25">Filtri</button>

    <div id="animation--service" class="animation--service mb-30">
        <div class="search-services">
            <div class="formgroup">
                <label for="rooms_min">Stanze:</label>
                <input type="number" name="rooms_min" id="rooms_min" min="1" value="1">
            </div>
            <div class="formgroup mb-10">
                <label for="rooms_min">Letti:</label>
                <input type="number" name="beds_min" id="beds_min" min="1" value="1">
            </div>
            <div class="formgroup distance-group">
                <label class="text-center" for="distance">Distanza: <span class="distanceVal"></span> km</label>
                <input class="slider" type="range" name="distance" id="distance" min="1" max="100" value="20">
            </div>
        </div>
        <div class="checkbox-services mt-15">
            @foreach(App\Service::all() as $service)
            <div class="services">
                <label for="service-{{ $service->id }}">{{ $service->type }}:</label>
                <input type="checkbox" class="service-checkbox" value="{{ $service->id }}"
                    id="service-{{ $service->id }}">
            </div>
            @endforeach
        </div>
    </div>
</form>