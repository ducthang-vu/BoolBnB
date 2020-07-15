@extends('shared.components.formAlgolia')

@section('formAlgoliaSupplement')

<div id="animation--service" class="animation--service">
    <div class="search-services">
        <div class="formgroup">
            <label for="rooms_min">Numero minimo di stanze:</label>
            <input
                type="number"
                name="rooms_min"
                id="rooms_min"
                min="1"
                value="1"
            >
        </div>
        <div class="formgroup">
            <label for="rooms_min">Numero minimo di letti:</label>
            <input
                type="number"
                name="beds_min"
                id="beds_min"
                min="1"
                value="1"
            >
        </div>
        <div class="formgroup">
            <label for="distance">Distanza:</label>
            <input
                type="number"
                name="distance"
                id="distance"
                min="1"
                value="20"
            >
        </div>
    </div>
    <div class="checkbox-services">
    @foreach(App\Service::all() as $service)
        <div class="services">
            <label for="service-{{ $service->id }}">{{ $service->type }}:</label>
            <input
                type="checkbox"
                class="service-checkbox"
                value="{{ $service->id }}"
                id="service-{{ $service->id }}"
            >
        </div>
    @endforeach
    </div>
</div>

    
@endsection
