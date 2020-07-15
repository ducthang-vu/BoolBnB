@extends('layouts.main')

@section('page-content')
    @include('shared.components.formAlgoliaApi')
    <div class="index-search d-flex s-center mb-20">
        <div class="search-card">
        @foreach ($flatsInRange as $flat)
            <a class="card-row card-row--index d-flex mb-10" href="{{ route('flats.show', $flat->id)}}" data-coordinates="{{$flat->getLatLngAsStr() }}" >
                <div class="image">
                    @if (!empty($flat->image))
                        <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
                    @else
                        <img src="https://i.ibb.co/bRN3hZD/casa.jpg" alt="casa">
                    @endif
                </div>
                <div class="desc-card ml-10">
                    <h2 class="mb-10">{{$flat->title}}</h2>
                    <p>{{$flat->address}}</p>
                    <p>{{$flat->getServicesId()}}</p>
                </div>
            </a>
        @endforeach
        </div>

        <div class="map">
            @include('shared.components.mapAlgolia')
        </div>
    </div>


    <script id="card-template" type="text/x-handlebars-template">
        <a class="card" href="{{ url('flats') }}/@{{ id }}">
            <div class="image">
                <div class="entry">
                    @{{#if image}}
                        <img src="{{ asset('storage/') }}@{{ image }}" alt="@{{ title }}">
                    @{{else}}
                        <img src="https://i.ibb.co/bRN3hZD/casa.jpg" alt="casa">
                    @{{/if}}
                </div>
            </div>
            <div class="desc-card ml-10">
                <h2 class="mb-10">@{{ title }}</h2>
            </div>
        </a>
    </script>
@endsection

