@extends('layouts.app')


@section('content')

{{-- Searchbar w. geolocation --}}
<form action="#" method="GET">
    @csrf
    @method('GET')
    <input type="text" name="address" id="address" placeholder="Cerca un appartamento">
    <input type="hidden" name="latlong" id="latlong">
    <input type="submit" value="Cerca">
</form>

@endsection