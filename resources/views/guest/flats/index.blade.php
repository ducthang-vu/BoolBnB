@extends('layouts.main')


@section('page-content')

    @include('shared.components.formAlgolia')

    <div class="service-section">
        {{-- @foreach ($services as $service)
            @dump($service)
        @endforeach --}}
    </div>
    @foreach ($flatsInRange as $flat)
        <p>{{ $flat->id }}</p>
    @endforeach
@endsection
