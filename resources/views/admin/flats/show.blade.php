@extends('layouts.main')

@section('page-content')
<div class="section-show-page">
    <div class="card-show">
        <div class="d-flex s-center transition-invisible">
            @if (session('flat-updated'))
            <div class="success-message">
                <p>{{ session('flat-updated') }} modificato correttamente.</p>
            </div>
            @endif
        </div>


        <div class="jumbotron pt-20 pb-20">
            <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
            <h1>{{$flat->title}}</h1>

        </div>

        <div class="description d-flex s-between pb-20">
            <div class="desc">
                <h2 class="mb-10">Descrizione</h2>
                <p>{{$flat->description}}</p>
            </div>
            <div class="desc-list">
                <h2 class="mb-10">Dettagli</h2>
                <ul>
                    <li>Numero di stanze: {{$flat->number_of_rooms}}</li>
                    <li>Numero di posti letto: {{$flat->number_of_beds}}</li>
                    <li>Numero di bagni: {{$flat->number_of_bathrooms}}</li>
                    <li>Metri quadrati: {{$flat->square_meters}}</li>
                    <li>Indirizzo: {{$flat->address }}</li>
                    <li>Include:
                        <ul class="ml-15">
                            @foreach ($flat->services->map(function($item) {
                            return $item->type;
                            }) as $service)
                            <li>{{ $service }}</li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-container d-flex s-between">
            <div class="map-description d-flex s-between">
                <h3 class="mb-10">Mappa</h3>
                <div class="map">
                    <input type="hidden" name="latlong" id="lat" value="{{ $flat->lat}}">
                    <input type="hidden" name="latlong" id="lng" value="{{ $flat->lng}}">
                    <div id="mapid" class="map-container mb-20"></div>
                </div>
            </div>
            <div class="button-card mb-20 d-flex align-center">
                <a class="btn btn-stat mb-5 mr-5 df-column " href="{{ route('admin.statistics' , $flat->id) }}"><i
                        class="far fa-chart-bar"></i><span class="top-text">Statistiche</span></a>
                <a class="btn btn-spons mb-5 mr-5"
                    href="{{ route('admin.sponsorships.create', ['flat_id' => $flat->id]) }}"><i
                        class="fas fa-hand-holding-usd"></i><span class="top-text">Sponsorizza</span></a>
                <a class="btn btn-edit mb-5 mr-5" href="{{ route('admin.flats.edit', $flat->id) }}"><i
                        class="far fa-edit"></i><span class="top-text">Modifica</span></a>
                <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete mb-5 mr-5"><i class="far fa-trash-alt"></i><span
                            class="top-text">Elimina</span></button>
                </form>
            </div>
        </div>
    </div>
    @endsection

</div>