@extends('layouts.main')

@section('page-content')
<div class="search-section df-column align-center">

    @include('shared.components.formAlgoliaApi')
    <div class="error-message">
        <h2>Non ci sono appartamenti per questa ricerca</h2>
    </div>


    <div class="index-search d-flex s-center">
        <div id="search-cards" class="search-cards">
        </div>

        <div class="map no-visibility">
            <div id="mapid"></div>
        </div>
    </div>
</div>

<script>
    let lat = '{{ $latlong[0] }}';
    let lng = '{{ $latlong[1] }}';
</script>

<script id="card-template" type="text/x-handlebars-template">
    @{{#each flats}}
        @{{#if sponsored}}
            <a class="card-flat d-flex sponsored p-10 mb-10" href="{{ url('flats') }}/@{{ id }}" data-coordinates="@{{ lat }}-@{{ lng }}">
        @{{else}}
            <a class="card-flat d-flex p-10 mb-10" href="{{ url('flats') }}/@{{ id }}" data-coordinates="@{{ lat }}-@{{ lng }}">
        @{{/if}}
                <div class="card__img-wrapper">
                    <img class="card__img" src="{{ asset('storage') }}/@{{ image }}" alt="@{{ title }}">
                </div>

                <div class="card__desc ml-10">
                    <h3 class="mb-10">@{{ title }}</h3>
                    <p class="card__desc__address">@{{address}}</p>
                    @{{#if sponsored}}
                    <p class="card__desc__sponsored">Sponsorizzato</p>
                    @{{/if}}
                </div>
                <div class="overlay">
                </div>
                @{{#if sponsored}}
                <i class="fas fa-medal"></i>
                @{{/if}}
            </a>
    @{{/each}}
</script>
@endsection