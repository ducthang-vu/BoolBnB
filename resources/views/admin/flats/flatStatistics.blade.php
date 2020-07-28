@extends('layouts.main')

@section('page-content')
    <header class="flatPagesHeader ml-30 mb-10">
        <a class="anchor" href="{{ route('admin.flats.show' , $flat->id) }}">Appartamento # {{ $flat->id}}</a>
        <i class="fas fa-chevron-right"></i>
        <span>Statistiche</span>
    </header>

    <div id="root" class="adminFlatStatistics"></div>
@endsection
