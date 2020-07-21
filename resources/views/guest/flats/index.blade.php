@extends('layouts.main')

@section('page-content')

    @include('shared.components.formAlgoliaApi')
    <div id="less-flats">
        <h2>Non ci sono appartamenti per questa ricerca</h2>
    </div>
    <div class="index-search d-flex s-center">
        <div id="search-cards" class="search-cards">
            @if ($flatsInRange->count())
                @foreach ($flatsInRange as $flat)
                <a class="card-row d-flex" href="{{ route('flats.show', $flat->id)}}" data-coordinates="{{ $flat->getLatLngAsStr() }}">
                    <div class="image">
                        <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
                    </div>
                    <div class="desc-card ml-10">
                        <h3 class="mb-10">{{$flat->title}}</h3>
                        <p>{{$flat->address}}</p>
                    </div>
                </a>
                @endforeach
            @else
            <div id="less-flats-blade">
                <h2>Non ci sono appartamenti per questa ricerca</h2>
            </div>
            @endif
        </div>
        @if ($flatsInRange->count())
        <div class="map">
            @include('shared.components.mapAlgolia')
        </div>
        @endif
    </div>

    <script id="card-template" type="text/x-handlebars-template">
        @{{#each flats}}
            <a class="card-row d-flex" href="{{ url('flats') }}/@{{ id }}" data-coordinates="@{{ lat }}-@{{ lng }}">
                <div class="image">
                    <img src="{{ asset('storage') }}/@{{ image }}" alt="@{{ title }}">
                </div>
                <div class="desc-card ml-10">
                    <h3 class="mb-10">@{{ title }}</h3>
                    <p>@{{address}}</p>
                </div>
            </a>
        @{{/each}}
    </script>
@endsection
