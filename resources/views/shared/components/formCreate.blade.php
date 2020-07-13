<form class="df-column" action="{{ route('admin.flats.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <label for="title">Titolo</label>
    <input type="text" name="title" id="title" value="{{ old('title') }}">
    <label for="description">Descrizione</label>
    <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
    <label for="number_of_rooms">Numero di stanze</label>
    <input type="number" name="number_of_rooms" id="number_of_rooms" value="{{ old('number_of_rooms') }}">
    <label for="number_of_beds">Numero di letti</label>
    <input type="number" name="number_of_beds" id="number_of_beds" value="{{ old('number_of_beds') }}">
    <label for="number_of_bathrooms">Numero di bagni</label>
    <input type="number" name="number_of_bathrooms" id="number_of_bathrooms" value="{{ old('number_of_bathrooms') }}">
    <label for="square_meters">Metri quadri</label>
    <input type="number" name="square_meters" id="square_meters" value="{{ old('square_meters') }}">
    <label for="address">Indirizzo</label>
    <input type="text" name="address" id="address" value="{{ old('address') }}">
    <label for="image">Immagine</label>
    <input type="file" name="image" id="image" accept="image/*" value="{{ old('image') }}">
    @foreach ($services as $service)
    <div>
        <input type="checkbox" name="services[]" id="service-{{ $loop->iteration }}" value="{{ $service->id }}">
        <label for="ag-{{ $loop->iteration }}">{{ $service->type }}</label>
    </div>
    @endforeach

    {{-- Acquisizione lat e long --}}
    <input type="hidden" name="latlong" id="latlong">
    <input type="submit" value="Aggiungi" class="btn-search">
</form>
