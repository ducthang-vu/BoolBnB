<div class="df-column align-center">
    <form class="df-column form mb-20" action="{{ route('admin.flats.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('POST')
        <ul>
            <li>
                <input type="text" name="title" class="field-style field-full" placeholder="Titolo"
                    value="{{ old('title')}}" />
            </li>
            <li>
                <textarea name="description" class="field-style"
                    placeholder="Descrizione">{{ old('description') }}</textarea>
            </li>
            <li class="d-flex s-between">
                <input type="number" name="number_of_rooms" class="field-style field-split align-left" min="1"
                    placeholder="Stanze" value="{{ old('number_of_rooms') }}" />
                <input type="number" name="number_of_beds" class="field-style field-split align-left" min="1"
                    placeholder="Letti" value="{{ old('number_of_beds') }}" />
            </li>
            <li class="d-flex s-between">
                <input type="number" name="number_of_bathrooms" class="field-style field-split align-left" min="1"
                    placeholder="Bagni" value="{{ old('number_of_bathrooms') }}" />
                <input type="number" name="square_meters" class="field-style field-split align-left" min="10"
                    placeholder="Metri quadri" value="{{ old('square_meters') }}" />
            </li>
            <li class="inputAlgolia-page">
                <input type="text" name="address" id="address" placeholder="Indirizzo">
                <input type="hidden" name="latlong" id="inputAlgolia-search__latlong">
            </li>
            <li>
                <label for="image">Immagine</label>
                <input class="field-style field-full" type="file" name="image" id="image" accept="image/*"
                    value="{{ old('image') }}">
            </li>
            <li class="services text-center">
                @foreach ($services as $service)
                <div class="form-group d-flex">
                    <input class="mr-10 ml-10" type="checkbox" name="services[]" id="service-{{ $loop->iteration }}"
                        value="{{ $service->id }}">
                    <label for="service-{{ $loop->iteration }}">{{ $service->type }}</label>
                </div>
                @endforeach
            </li>
            <li class="radio-input mt-20">
                <input class="radio" type="radio" name="is_active" id="is_active_yes" value="1" checked>
                <label class="radio-label-form" for="is_active_yes">
                    <i class="far fa-eye"></i> Visibile nelle ricerche
                </label>
                <input class="radio" type="radio" name="is_active" id="is_active_no" value="0">
                <label class="radio-label-form" for="is_active_no">
                    <i class="far fa-eye-slash"></i> Non visibile nelle ricerche
                </label>
            </li>
            <li>
                <input class="btn-search" type="submit" value="Aggiungi appartamento" />
            </li>
        </ul>
    </form>
</div>