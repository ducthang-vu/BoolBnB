@extends('layouts.main')

@section('page-content')
<div class="adminFlatsShow-page">
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
    @if (session('flat-updated'))
    <div class="success-message message-animation">
        <h2> Appartamento modificato correttamente.</h2>
    </div>
    @endif
    @if (Auth::check() && $flat->user_id == Auth::user()->id && !$flat->is_active)
    <h2 class="notification-flat-hidden p-10 mt-10 text-center">
        <i class="icon far fa-eye-slash"></i><span>Questo appartamento non è visibile nelle ricerche.</span>
    </h2>
    @endif
    @include('shared.components.cardFlatShow')
</div>
@endsection

@section('page-popup')
<div class="adminFlatsShow-page-popup">
    @if (Auth::check() && $flat->user_id == Auth::user()->id)
    <form id="popup-delete" class="popup-delete p-15" action="{{ route('admin.flats.destroy', $flat->id) }}"
        method="POST">
        @csrf
        @method('DELETE')
        <h3 class="mt-15 mb-15">Sei sicuro di voler eliminare l'appartamento?</h3>
        <p class="mb-10">La cancellazione non potrà essere revocata</p>
        @if ($flat->is_active)
        <p class="mb-10">Potresti invece considerare di nascondere l'appartamento dalle ricerche.</p>
        @endif
        <div class="form-group d-flex s-center">
            <input type="submit" id="btn-delete" class="m-10 btn-link" value="Sì, elimina">
            <button id="btn-cancel" class="btn-cancel m-10 btn-link" type="button">No, annulla</button>
        </div>
    </form>
    <div class=layer></div>

    <nav class="options-small">
        <ul class="options-small__list text-center">
            <li class="in-block">
                <a href="{{ route('admin.statistics' , $flat->id) }}" class="in-block text-center p-10">Statistiche</a>
            </li>
            <li class="in-block">
                <a href="{{ route('admin.sponsorships.create', ['flat_id' => $flat->id]) }}"
                    class="in-block text-center p-10">Sponsorizza</a>
            </li>
            <li class="in-block">
                <a href="{{ route('admin.flats.edit', $flat->id) }}" class="in-block text-center p-10">Modifica</a>
            </li>
            <li class="in-block">
                <button id="btn-delete-small" class="in-block text-center p-10">
                    Elimina
                </button>
            </li>
        </ul>
    </nav>
    @endif
</div>
@endsection