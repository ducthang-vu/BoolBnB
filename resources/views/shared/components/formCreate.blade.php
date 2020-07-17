<div class="edit-form df-column align-center">
    <form class="df-column" action="{{ route('admin.flats.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="title df-column align-center">
            <label for="title">Titolo</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
        </div>

        <div class="edit-description">
            <div class="desc-one df-column align-center">
                <label for="description">Descrizione</label>
                <textarea name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
            </div>
        

            <div class="desc-two df-column align-center">
                <div class="d-flex s-center align-center">
                    <label for="number_of_rooms">Numero di stanze</label>
                    <input type="number" name="number_of_rooms" id="number_of_rooms" value="{{ old('number_of_rooms') }}">
                    <label for="number_of_beds">Numero di letti</label>
                    <input type="number" name="number_of_beds" id="number_of_beds" value="{{ old('number_of_beds') }}">
                </div>
                
                <div class="d-flex s-center align-center">
                    <label for="number_of_bathrooms">Numero di bagni</label>
                    <input type="number" name="number_of_bathrooms" id="number_of_bathrooms" value="{{ old('number_of_bathrooms') }}">
                    <label for="square_meters">Metri quadri</label>
                    <input type="number" name="square_meters" id="square_meters" value="{{ old('square_meters') }}">
                </div>
                
            </div>
        </div>

        <div class="address df-column align-center">
            <label for="address">Indirizzo</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}">
        </div>

        <div class="add-image df-column align-center">    
            <label for="image">Immagine</label>
            <input type="file" name="image" id="image" accept="image/*" value="{{ old('image') }}">
        </div>

        <div class="services df-column align-center">
            @foreach ($services as $service)
                <input type="checkbox" name="services[]" id="service-{{ $loop->iteration }}" value="{{ $service->id }}">
                <label for="ag-{{ $loop->iteration }}">{{ $service->type }}</label>
            @endforeach
        </div>
        {{-- Acquisizione lat e long --}}
        <input type="hidden" name="latlong" id="latlong">
        <input type="submit" value="Aggiungi" class="btn-search">
    </form>
</div>
