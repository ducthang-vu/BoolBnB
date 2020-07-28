@extends('layouts.main')

@section('page-content')
<div class="adminFlatsEdit mt-20">
    @if ($errors->any())
    <div class="error-message message-animation">
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                <h2>{{ $error }}</h2>
            </li>
            @endforeach
        </ul>
    </div>
    @endif


    <header class="flatPagesHeader mb-25">
        <a class="anchor" href="{{ route('admin.flats.show' , $flat->id) }}">Appartamento # {{ $flat->id}}</a>
        <i class="fas fa-chevron-right"></i>
        <span>Modifica & aggiorna</span>
    </header>

    @include('shared.components.formEdit')
</div>
@endsection
