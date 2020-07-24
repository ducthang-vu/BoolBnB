<div class="df-column align-center">
    <form class="df-column form mb-20" action="{{ route('admin.flats.update', $flat->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <ul>
            <li>
                <label for="title">Titolo</label>
                <input type="text" name="title" class="field-style field-full" placeholder="Titolo"
                    value="{{ old('title', $flat->title) }}" />
            </li>
            <li>
                <label for="description">Descrizione</label>
                <textarea name="description" class="field-style"
                    placeholder="Descrizione">{{ old('description', $flat->description) }}</textarea>
            </li>
            <li class="d-flex s-around">
                <div class="df-column w-100">
                    <label for="number_of_rooms">Stanze</label>
                    <input type="number" name="number_of_rooms" class="field-style field-full align-left" min="1"
                        placeholder="Stanze" value="{{ old('number_of_rooms', $flat->number_of_rooms) }}" />
                </div>
                <div class="df-column w-100">
                    <label for="number_of_beds">Letti</label>
                    <input type="number" name="number_of_beds" class="field-style field-full align-left" min="1"
                        placeholder="Letti" value="{{ old('number_of_beds', $flat->number_of_beds) }}" />
                </div>
            </li>
            <li class="d-flex s-around">
                <div class="df-column w-100">
                    <label for="number_of_bathrooms">Bagni</label>
                    <input type="number" name="number_of_bathrooms" class="field-style field-full align-left" min="1"
                        placeholder="Bagni" value="{{ old('number_of_bathrooms', $flat->number_of_bathrooms) }}" />
                </div>
                <div class="df-column w-100">
                    <label for="square_meters">Metri quadri</label>
                    <input type="number" name="square_meters" class="field-style field-full align-left" min="10"
                        placeholder="Metri quadri" value="{{ old('square_meters', $flat->square_meters) }}" />
                </div>
            </li>
            <li class="inputAlgolia-page">
                <label for="address">Indirizzo</label>
                <input type="text" name="address" id="address" placeholder="Indirizzo"
                    value="{{ old('address', $flat->address) }}">
                <input type="hidden" name="latlong" id="inputAlgolia-search__latlong"
                    value="{{ $flat->lat }},{{ $flat->lng }}">
            </li>
            <li>
                <label for="image">Immagine <br><sub class="in-block mb-5">* Ignora per conservare l'immagine
                        corrente</sub></label>
                <input class="field-style field-full" type="file" name="image" id="image" accept="image/*"
                    value="{{ old('image', asset('storage/' . $flat->image )) }}">

            </li>
            <li class="services text-center mt-30">
                @foreach ($services as $service)
                <div class="form-group d-flex">
                    <input class="mr-10 ml-10" type="checkbox" name="services[]" id="service-{{ $loop->iteration }}"
                        value="{{ $service->id }}" @if($flat->services->contains($service->id))
                    checked
                    @endif>
                    <label for="service-{{ $loop->iteration }}">{{ $service->type }}</label>
                </div>
                @endforeach
            </li>
            <li class="radio-input mt-20">
                <input class="radio" type="radio" name="is_active" id="is_active_yes" value="1" @if($flat->is_active)
                checked
                @endif>
                <label class="radio-label-form" for="is_active_yes">
                    <i class="far fa-eye"></i><span>Visibile nelle ricerche</span>
                </label>
                <input class="radio" type="radio" name="is_active" id="is_active_no" value="0" @if(!$flat->is_active)
                checked
                @endif>
                <label class="radio-label-form" for="is_active_no">
                    <i class="far fa-eye-slash"></i><span>Non visibile nelle ricerche</span>
                </label>
            </li>
            <li class="mt-30">
                <input class="btn-search" type="submit" value="Modifica appartamento" />
            </li>
        </ul>
    </form>
</div>