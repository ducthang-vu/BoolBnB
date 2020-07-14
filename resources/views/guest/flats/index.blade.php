@extends('layouts.main')

@section('page-content')
    @include('shared.components.formAlgoliaApi')
        <style>
            #mapid {
                height: 300px;
            }
        </style>

<div class="index-search d-flex s-center">
    <div id="search-cards" class="search-cards">
        @foreach ($flatsInRange as $flat)
            <a class="card" href="{{ route('flats.show', $flat->id)}}" data-coordinates="{{$flat->getLatLngAsStr() }}" >
                <div class="image">
                    @if (!empty($flat->image))
                        <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
                    @else
                        <img src="https://i.ibb.co/bRN3hZD/casa.jpg" alt="casa">
                    @endif
                </div>
                <div class="desc-card ml-10">
                    <h2 class="mb-10">{{$flat->title}}</h2>
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
        <a class="card" href="{{ url('flats') }}/@{{ id }}" >
            <div class="image">
                {{--<img src="{{ url('storage') }}/@{{ image }}" alt="@{{ title }}">--}}
                <img src="https://i.ibb.co/bRN3hZD/casa.jpg" alt="casa">
            </div>
            <div class="desc-card ml-10">
                <h2 class="mb-10">@{{ title }}</h2>
            </div>
        </a>
    @{{/each}}
</script>
@endsection

