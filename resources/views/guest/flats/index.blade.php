@extends('layouts.main')


@section('page-content')

    @include('shared.components.formAlgolia')

    <div class="service-section">
    @foreach ($services as $service)
        <input type="checkbox" name="services[]" id="service-{{ $loop->iteration }}" value="{{ $service->id }}"
            @if($flat->services->contains($service->id))
                checked
            @endif>
        <label for="ag-{{ $loop->iteration }}">{{ $service->type }}</label>
    @endforeach
    </div>
    @foreach ($flatsInRange as $flat)
        <p>{{ $flat->id }}</p>
    @endforeach
@endsection
