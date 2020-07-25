<div class="cardFlatShow-page">
    <div class="cardFlatShow-page__container d-flex">
        <img class="main-image mb-20" src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
        <header class="page-header mb-15">
            <h1 class="mb-10 weight-500">
                {{$flat->title}}
            </h1>
            <p>{{$flat->address}}</p>
        </header>
        <ul class="mb-15 details-list">
            <li class="pb-5 pt-5 in-block details">{{$flat->number_of_rooms}}
                stanz{{$flat->number_of_rooms > 1 ? 'e' : 'a'}}</li>
            <li class="pb-5 pt-5 in-block details">{{$flat->number_of_beds}}
                lett{{$flat->number_of_beds > 1 ? 'i' : 'o'}}
            </li>
            <li class="pb-5 pt-5 in-block details">{{$flat->number_of_bathrooms}}
                bagn{{$flat->number_of_bathrooms > 1 ? 'i' : 'o'}}
            </li>
            <li class="pb-5 pt-5 in-block details">{{$flat->square_meters}} mq</li>
        </ul>
        <section class="mb-30">
            <h2 class="services-title pb-5 mb-5 weight-500">Servizi:</h2>
            <ul class="services-list ml-15">
                @foreach ($flat->services as $service)
                <li class="services pb-5 pt-5">
                    <div class="icon-box d-in-flex s-center align-center">
                        {!! $service->getIcon() !!}
                    </div>
                    <span class="in-block">{{ $service->type }}</span>
                </li>
                @endforeach
            </ul>
        </section>

        <div class="row mb-40">
            <h2 class="mb-10 weight-500">Descrizione</h2>
            <p class=" row__description l-height-150">{{$flat->description}}</p>
        </div>
        <div class="form-container df-column">
            @if (Auth::check() && $flat->user_id == Auth::user()->id)
            <div class="options-big p-30 text-center">
                <h3 class="mb-15">Opzioni</h3>
                <ul class="options-big__list d-flex s-center">
                    <li class="pt-5 mb-15"><a class="btn-link d-flex s-center text-center"
                            href="{{ route('admin.home')}}">Vai alla
                            lista dei
                            tuoi
                            appartamenti</a>
                    </li>
                    <li class="pt-5"><a class="btn-link d-flex s-between pl-10 pr-10"
                            href="{{ route('admin.statistics' , $flat->id) }}"><i
                                class="far fa-chart-bar"></i><span>Statistiche</span></a></li>
                    <li class="pt-5"><a class="btn-link d-flex s-between pl-10 pr-10"
                            href="{{ route('admin.sponsorships.create', ['flat_id' => $flat->id]) }}"><i
                                class="fas fa-medal"></i><span>Sponsorizza</span></a></li>
                    <li class="pt-5"><a class="btn-link d-flex s-between pl-10 pr-10"
                            href="{{ route('admin.flats.edit', $flat->id) }}"><i
                                class="far fa-edit"></i><span>Modifica</span></a></li>
                    <li class="pt-5"><button id="btn-delete-big" class="btn-link d-flex s-between pl-10 pr-10">
                            <i class="far fa-trash-alt"></i><span>Elimina</span>
                        </button></li>
                </ul>
            </div>
            <form id="popup-delete" class="popup-delete p-15" action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <h3 class="mt-15 mb-15">Sei sicuro di voler eliminare l'appartamento?</h3>
                <p class="mb-10">La cancellazione non potrà essere revocata</p>
                @if ($flat->is_active)
                    <p class="mb-10">Potresti invece considerare di nascondere l'appartamento dalle ricerche.</p>
                @endif
                <div class="form-group d-flex s-center">
                    <input type="submit" id="btn-delete" class="btn-delete m-10 btn-link" value="Sì, elimina">
                    <button id="btn-cancel" class="btn-cancel m-10 btn-link" type="button">No, annulla</button>
                </div>
            </form>
            <div class=layer></div>
            @else
            <form class="form form-message mb-40" action="{{ route('requests') }}" method="POST">
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
            @endif
        </div>
    </div>
    <section class="map-section">
        <h2 class="mt-20 mb-10 weight-500">Posizione</h2>
        <div class="map">
            <input type="hidden" name="latlong" id="lat" value="{{ $flat->lat}}">
            <input type="hidden" name="latlong" id="lng" value="{{ $flat->lng}}">
            <div id="mapid" class="map-container mb-20"></div>
        </div>
    </section>
    @if (Auth::check() && $flat->user_id == Auth::user()->id)
        <nav class="options-small">
            <ul class="options-small__list text-center">
                <li class="in-block p-10">
                    <a href="{{ route('admin.statistics' , $flat->id) }}" class="in-block text-center">Statistiche</a>
                </li>
                <li class="in-block p-10">
                    <a href="{{ route('admin.sponsorships.create', ['flat_id' => $flat->id]) }}" class="in-block text-center">Sponsorizza</a>
                </li>
                <li class="in-block p-10">
                    <a href="{{ route('admin.flats.edit', $flat->id) }}" class="in-block text-center">Modifica</a>
                </li>
                <li class="in-block p-10">
                    <button id="btn-delete-small" class="in-block text-center">
                        Elimina
                    </button>
                </li>
            </ul>
        </nav>
    @endif
</div>

<script>
    function popupToggle() {
        document.getElementById('popup-delete').classList.toggle('d-flex')
        document.querySelector('.map-section').classList.toggle('no-visibility')
    }
    document.getElementById('btn-delete-big').addEventListener('click', popupToggle)
    document.getElementById('btn-delete-small').addEventListener('click', popupToggle)
    document.getElementById('btn-cancel').addEventListener('click', popupToggle)
</script>
