<div class="search-home d-flex">
    <form action=" {{ route('search') }}" method="GET">
        @csrf
        @method('GET')
        <input type="text" name="address" id="address" placeholder="Cerca un appartamento">
        <input type="hidden" name="latlong" id="latlong">
        <input type="submit" value="Cerca" class="btn-search">
    </form>
</div>


