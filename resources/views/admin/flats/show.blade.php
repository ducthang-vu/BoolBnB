@extends('layouts.main')

@section('page-content')
    <div class="adminFlatsShow-page">
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
