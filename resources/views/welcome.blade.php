@extends('layouts.main')

@section('page-content')

<div class="dev">
    <div class="pic-card d-flex s-center">
        <img src="https://i.ibb.co/64Pxb9p/maxresdefault.jpg" alt="maxresdefault">
    </div>
    
    @include('shared.components.formAlgoliaHome')
    
    
    <div class="sponsorship-card d-flex s-center">
        @foreach($sponsoredFlats as $sponsoredFlat)
    
        <a class="card" href="{{ route('flats.show' , $sponsoredFlat->id) }}">
            <div class="image-dev">
                <img src="{{ asset('storage/' . $sponsoredFlat->image ) }}" alt="{{$sponsoredFlat->title}}">
            </div>
            
            <div class="overlay-card">
                {{$sponsoredFlat->title}}
            </div>
        </a>
    
        @if ($loop->index == 5)
        @break;
        @endif
        @endforeach
    </div>
</div>



@endsection