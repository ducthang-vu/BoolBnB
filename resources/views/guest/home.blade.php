@extends('layouts.main')

@section('page-content')
<div class="section-home">
    <div class="pic-card d-flex s-center">
        <img src="{{asset('storage/img_jumbotron/jumbotron.jpg')}}" alt="maxresdefault">
        @include('shared.components.formAlgoliaHome')
    </div>

    <h1 class="mb-30 text-center">La tua prossima vacanza</h1>
    <div class="sponsorship-card d-flex s-center">
        @foreach($sponsoredFlats as $sponsoredFlat)
        <a class="card" href="{{ route('flats.show' , $sponsoredFlat->id) }}">
            <div class="image-card">
                <img src="{{ asset('storage/' . $sponsoredFlat->image ) }}" alt="{{$sponsoredFlat->title}}">
            </div>

            <div class="text-card">
                <h5>{{$sponsoredFlat->title}}</h5>
                <p>{{$sponsoredFlat->address}}</p>
            </div>
        </a>
        @if ($loop->index == 5)
        @break;
        @endif
        @endforeach
    </div>
</div>
@endsection