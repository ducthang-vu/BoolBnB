@extends('layouts.main')

@section('page-content')
@include('shared.components.formAlgoliaHome')

<h1 class="title-home text-center">Appartamenti sponsorizzati</h1>
<div class="sponsorship-card d-flex s-center">
    @foreach($sponsoredFlats as $sponsoredFlat)

    <a class="card" href="{{ route('flats.show' , $sponsoredFlat->id) }}">
        <img src="{{ asset('storage/' . $sponsoredFlat->image ) }}" alt="{{$sponsoredFlat->title}}">
        <h3>{{$sponsoredFlat->title}}</h3>
    </a>

    @if ($loop->index == 5)
    @break;
    @endif
    @endforeach
    @endsection
