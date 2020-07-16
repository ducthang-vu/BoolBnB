@extends('layouts.main')

@section('page-content')
    @include('shared.components.formAlgolia')

    <div class="home-blade-content">
        <h1 class="title-home">Appartamenti sponsorizzati</h1>
        <div class="sponsorship-card d-flex">
        @foreach($sponsoredFlats as $sponsoredFlat)

            <a class="card" href="{{ route('flats.show' , $sponsoredFlat->id) }}">
                @if (!empty($sponsoredFlat->image))
                    <img src="{{ asset('storage/' . $sponsoredFlat->image ) }}" alt="{{$sponsoredFlat->title}}">
                @else
                    <img src="https://i.ibb.co/bRN3hZD/casa.jpg" alt="casa">
                @endif
                <h3>{{$sponsoredFlat->title}}</h3>
            </a>

            @if ($loop->index == 7)
                @break;
            @endif
        @endforeach
    </div>
    
@endsection
