@extends('layouts.main')

@section('page-content')

    @include('shared.components.formAlgoliaApi')
    <div class="index-search d-flex s-center">
        <div id="search-cards" class="search-cards">
            @foreach ($flatsInRange as $flat)
            <a class="card-row d-flex" href="{{ route('flats.show', $flat->id)}}" data-coordinates="{{$flat->getLatLngAsStr() }}">
                <div class="image">
                    <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
                </div>
                <div class="desc-card ml-10">
                    <h3 class="mb-10">{{$flat->title}}</h3>
                    <p>{{$flat->address}}</p>
                </div>
            </a>
            @endforeach
        </div>

        <div class="map">
            @include('shared.components.mapAlgolia')
        </div>
    </div>

    <script id="card-template" type="text/x-handlebars-template">
        @{{#each flats}}
            <a class="card" href="{{ url('flats') }}/@{{ id }}" data-coordinates="@{{ lat }}-@{{ lng }} >
                <div class="image">
                    <img src="{{ asset('storage') }}/@{{ image }}" alt="{{$flat->title}}">
                </div>

                <div class="desc-card ml-10">
                    <h2 class="mb-10">@{{ title }}</h2>
                </div>
            </a>
        @{{/each}}
    </script>
@endsection
