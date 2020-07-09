@extends('layouts.main')


@section('page-content')

@include('shared.components.formAlgolia')

<div class="service-section">
    {{-- @foreach ($services as $service)
        @dump($service)
    @endforeach --}}
</div>

@foreach($sponsoredFlats as $sponsoredFlat)
    
        <a class="card-serach d-flex mb-20" href="{{ route('flats.show' , $sponsoredFlat->id) }}">

            <img src="{{$sponsoredFlat->image}}" alt="{{$sponsoredFlat->title}}">

            <div class="desc-search ml-10">
                <h2 class="mb-10">{{$sponsoredFlat->title}}</h2>

                <p>{{$sponsoredFlat->description}}</p>
            </div>
            
        </a>

        @if ($loop->index == 1)
            @break;
        
        @endif

@endforeach

@endsection