<div class="search-home d-flex">
    <form action=" {{ route('flats.index') }}" method="GET" id="algoliaForm">
        @csrf
        @method('GET')
        <input type="text" name="address" id="address" placeholder="Cerca un appartamento">
        <input type="hidden" name="latlong" id="latlong">
        @yield('formAlgoliaSupplement')
        <input type="submit" value="Cerca" class="btn-search">
    </form>
</div>


