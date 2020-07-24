@extends('layouts.main')

@section('page-content')

@include('shared.components.formAlgoliaApi')
<div class="error-message">
    <h2>Non ci sono appartamenti per questa ricerca</h2>
</div>
<div class="index-search d-flex s-center">
    <div id="search-cards" class="search-cards"></div>

    <div class="map no-visibility">
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
