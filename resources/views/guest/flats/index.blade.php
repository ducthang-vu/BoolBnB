@extends('layouts.main')

@section('page-content')

@include('shared.components.formAlgoliaApi')
<div class="error-message @unless (count($flatsInRange)) message-animation @endunless">
    <h2>Non ci sono appartamenti per questa ricerca</h2>
</div>
<div class="index-search d-flex s-center">
    <div id="search-cards" class="search-cards">
        @if (count($flatsInRange))
        @foreach ($flatsInRange as $flat)
        <a class="card-row d-flex @if (App\Flat::find($flat['id'])->hasActiveSponsorship()) sponsored @endif"
            href="{{ route('flats.show', $flat['id'])}}"
            data-coordinates="{{ App\Flat::find($flat['id'])->getLatLngAsStr() }}">
            <div class="overlay">
                <div class="overlay-left">Visualizza dettagli</div>
                <div class="overlay-right"></div>
            </div>
            <div class="image">
                <img src="{{ asset('storage/' . $flat['image'] ) }}" alt="{{$flat['title']}}">
            </div>
            <div class="desc-card ml-10">
                <h3 class="mb-10">{{$flat['title']}}</h3>
                <p class="desc-card__address">{{$flat['address']}}</p>
            </div>
        </a>
        @endforeach
        @endif
    </div>
    <div class="map @unless(count($flatsInRange)) no-visibility @endunless">
        @include('shared.components.mapAlgolia')
    </div>
</div>

<script id="card-template" type="text/x-handlebars-template">
    @{{#each flats}}
    @{{#if sponsored}}
    <a class="card-row d-flex sponsored" href="{{ url('flats') }}/@{{ id }}" data-coordinates="@{{ lat }}-@{{ lng }}">
        @{{else}}
    <a class="card-row d-flex" href="{{ url('flats') }}/@{{ id }}" data-coordinates="@{{ lat }}-@{{ lng }}">
        @{{/if}}
        <div class="image">
            <img src="{{ asset('storage') }}/@{{ image }}" alt="@{{ title }}">
        </div>
        <div class="desc-card ml-10">
            <h3 class="mb-10">@{{ title }}</h3>
            <p class="desc-card__address">@{{address}}</p>
        </div>
        <div class="overlay">
            <div class="overlay-left">Visualizza dettagli</div>
            <div class="overlay-right"></div>
        </div>
    </a>
    @{{/each}}
</script>
@endsection