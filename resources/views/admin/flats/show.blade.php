@extends('layouts.main')

@section('page-content')
<div class="card-show">
    @if (session('flat-updated'))
    <div>
        <p>{{ session('flat-updated') }} modificato correttamente.</p>
    </div>
    
    @endif

  <div class="jumbotron pt-20 pb-20">

    @if (!empty($flat->image))
        <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
    @else
        <img src="https://i.ibb.co/bRN3hZD/casa.jpg" alt="casa">
    @endif

    <h1>{{$flat->title}}</h1>   

  </div>

  <div class="description d-flex pb-20">
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

  <div class="map-description d-flex">
      <div class="map">
          <h3>Mappa</h3>
      </div>

      <div class="button-card d-flex mb-20">
          <a class="btn btn-spons mb-5 mr-5" href="{{ route('admin.sponsorships.create', ['flat_id' => $flat->id]) }}">Sponsorizza</a>
          <a class="btn btn-edit mb-5 mr-5" href="{{ route('admin.flats.edit', $flat->id) }}">Modifica</a>
          <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <input class="btn btn-delete" type="submit" value="Elimina">
        </form>
      </div>
  </div>
</div>
@endsection
