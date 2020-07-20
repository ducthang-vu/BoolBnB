{{--
DOCUMENTATION:
This template need to be include with a parameter of model App\Flat
--}}
<div class="card-show">
    <div class="jumbotron pt-20 pb-20">
        <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
        <h1>{{$flat->title}}</h1>

    </div>

    <div class="description d-flex s-between">
        <div class="desc">
            <h2 class="mb-10">Descrizione</h2>
            <p>{{$flat->description}}</p>
        </div>
        <div class="desc-list">
            <h2 class="mb-10">Servizi</h2>
            <ul>
                <li>Numero di stanze: {{$flat->number_of_rooms}}</li>
                <li>Numero di posti letto: {{$flat->number_of_beds}}</li>
                <li>Numero di bagni: {{$flat->number_of_bathrooms}}</li>
                <li>Metri quadrati: {{$flat->square_meters}}</li>
                <li>Indirizzo: {{$flat->address }}</li>
            </ul>
        </div>
    </div>

    <h3 class="mb-10">Mappa</h3>
    <div class="map-description d-flex s-between">
        <div class="map">
            <input type="hidden" name="latlong" id="lat" value="{{ $flat->lat}}">
            <input type="hidden" name="latlong" id="lng" value="{{ $flat->lng}}">
            <div id="mapid" class="map-container"></div>
        </div>

        <div class="button-card mb-20">
            @auth
            @if ($flat->user_id == Auth::user()->id)
            <a class="btn btn-spons mb-5"
                href="{{ route('admin.sponsorships.create', ['flat_id' => $flat->id]) }}">Sponsorizza</a>
            <a class="btn btn-edit mb-5" href="">Modifica</a>
            <a class=" btn btn-delete mb-5" href="">Elimina</a>
            @endauth
            @else
            @guest

            <h3>Scrivi al proprietario</h3>

            <form class="form-message" action="{{ route('requests') }}" method="POST">
                @csrf
                @method('POST')
                <div class="accountholder d-flex">
                    <div class="form-group">
                        <label for="form_surname">Cognome </label>
                        <input type="text" class="form-control" name="surname" id="form_surname"
                            value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <label for="form_name">Nome </label>
                        <input type="text" class="form-control" name="name" id="form_name" value="{{ old('title') }}">
                    </div>
                </div>

                <div class="accountholder-mail d-flex">
                    <div class="form-group">
                        <label for="form_email">Email </label>
                        <input type="email" class="form-control" name="email" id="form_email"
                            value="{{ old('title') }}">
                    </div>
                </div>

                <div class="form-group-message d-flex">
                    <label for="form_message">Message </label>
                    <textarea name="message" id="form_message" cols="30" rows="10" class="form-control">
                                {{ old('body') }}
                            </textarea>
                </div>

                <input type="hidden" class="form-control" name="flat_id" id="flat_id" value="{{ $flat->id }}">
                <input type="submit" value="Invia" class="btn btn-message">
            </form>
            @endguest
            @endif
        </div>
    </div>
</div>