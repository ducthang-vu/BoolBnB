@extends('shared.components.formAlgolia')

@section('formAlgoliaSupplement')
    <div class="formgroup">
        <label for="rooms_min">Numero minimo di stanze:</label>
        <input
            type="number"
            name="rooms_min"
            id="rooms_min"
            min="1"
        >
    </div>
    <div class="formgroup">
        <label for="rooms_min">Numero minimo di letti:</label>
        <input
            type="number"
            name="beds_min"
            id="beds_min"
            min="1"
        >
    </div>
    <div class="formgroup">
        <label for="distance">Distanza:</label>
        <input
            type="number"
            name="distance"
            id="distance"
            min="1"
        >
    </div>
    @foreach(App\Service::all() as $service)
        <label for="service-{{ $service->id }}">{{ $service->type }}</label>
        <input
            type="checkbox"
            class="service-checkbox"
            value="{{ $service->id }}"
            id="service-{{ $service->id }}"
        >
    @endforeach
@endsection
