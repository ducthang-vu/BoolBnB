<div class="cardFlatShow-page">
    <header class="page-header mb-30 mt-30">
        <h1 class="mb-10">
            {{$flat->title}}
        </h1>
        <p>{{$flat->address}}</p>
    </header>
    <div class="cardFlatShow-page__jumbotron d-flex">
        <img class="mb-20" src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
        <div class="details mb-20">
            <h2 class="mb-10">Dettagli:</h2>
            <ul>
                <li class="pb-5 pt-5">Numero di stanze: <strong>{{$flat->number_of_rooms}}</strong></li>
                <li class="pb-5 pt-5">Numero di posti letto: <strong>{{$flat->number_of_beds}}</strong></li>
                <li class="pb-5 pt-5">Numero di bagni: <strong>{{$flat->number_of_bathrooms}}</strong></li>
                <li class="pb-5 pt-5">Metri quadrati: <strong>{{$flat->square_meters}}</strong></li>
                <li class="pb-5 pt-10"><strong>Servizi:</strong>
                    <ul class="ml-15">
                        @foreach ($flat->services as $service)
                        <li class="services pb-5 pt-5">
                            <div class="icon-box d-in-flex s-center align-center">
                                {!! $service->getIcon() !!}
                            </div>
                            <span class="in-block">{{ $service->type }}</span>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="row mb-40">
        <h2 class="mb-10">Descrizione</h2>
        <p class=" row__description l-height-150">{{$flat->description}}</p>
    </div>
    <div>
        <div class="df-column mb-20">
            <form class="form form-message" action="{{ route('requests') }}" method="POST">
                <h3 class="mb-30">Scrivi al proprietario</h3>
                @csrf
                @method('POST')
                <ul class="accountholder df-column ">
                    <li>
                        <div class="w-100 d-flex">
                            <div class="df-column">
                                <label class="mb-5" for="form_name">Nome</label>
                                <input type="text" class="field-style field-full" name="name" id="form_name"
                                    placeholder="Nome"
                                    value="@auth {{ old('name', Auth::user()->name) }}@endauth @guest{{ old('name') }} @endguest">
                            </div>
                            <div class="df-column">
                                <label class="mb-5" for="form_surname">Cognome</label>
                                <input type="text" class="field-style field-full" name="surname" id="form_surname"
                                    placeholder="Cognome" value="@auth {{ old('surname', Auth::user()->surname) }}@endauth
                                @guest{{ old('surname') }} @endguest">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="w-100 df-column">
                            <label class="mb-5" for="form_email">Email</label>
                            <input type="email" class="field-style field-full" name="email" id="form_email"
                                value="@auth {{ old('email', Auth::user()->email) }}@endauth @guest{{ old('email') }} @endguest">
                        </div>
                    </li>
                    <li>
                        <div class="w-100 df-column">
                            <label class="mb-5" for="form_message">Messaggio</label>
                            <textarea name="message" id="form_message" class="field-style"
                                placeholder="Chiedi qualcosa al proprietario">{{ old('message') }}</textarea>
                        </div>
                    </li>
                    <li class="mt-20">
                        <input type="hidden" class="form-control" name="flat_id" id="flat_id" value="{{ $flat->id }}">
                        <input type="submit" value="Invia" class="btn btn-search">
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <div class="map-description">
        <h2 class="mt-40 mb-10">Posizione</h2>
        <div class="map">
            <input type="hidden" name="latlong" id="lat" value="{{ $flat->lat}}">
            <input type="hidden" name="latlong" id="lng" value="{{ $flat->lng}}">
            <div id="mapid" class="map-container mb-20"></div>
        </div>

    </div>
</div>