@extends('layouts.main')


@section('page-content')

<div class="search-home d-flex">
    <form action="#" method="GET">
        @csrf
        @method('GET')
        <input type="text" name="address" id="address" placeholder="Cerca un appartamento">
        <input type="hidden" name="latlong" id="latlong">
        <input type="submit" value="Cerca" class="button-home">
    </form>
</div>

<h1 class="title-home">Appartamenti sponsorizzati</h1>

<div class="sponsorship-card d-flex">
    @foreach($sponsoredFlats as $sponsoredFlat)
    <a class="card" href="">

    <img src="{{$sponsoredFlat->image}}" alt="{{$sponsoredFlat->title}}">

    <h3>{{$sponsoredFlat->title}}</h3>

    </a>

    @if ($loop->index == 5)
        @break;
    
    @endif
    @endforeach
</div>
    



@endsection
