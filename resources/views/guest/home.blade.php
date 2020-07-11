@extends('layouts.main')

{{-- @section('page-content')
    @include('shared.components.formAlgolia')

<h1 class="title-home">Appartamenti sponsorizzati</h1>

<div class="sponsorship-card d-flex">
    @foreach($sponsoredFlats as $sponsoredFlat)

        <a class="card" href="{{ route('flats.show' , $sponsoredFlat->id) }}">

            <img src="{{$sponsoredFlat->image}}" alt="{{$sponsoredFlat->title}}">

            <h3>{{$sponsoredFlat->title}}</h3>

        </a>

        @if ($loop->index == 5)
            @break;
        @endif

    @endforeach
</div>
@endsection --}}
