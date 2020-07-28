@extends('layouts.main')


@section('page-content')
@if(session('created'))
    <div class="success-message message-animation">
        <h2>Il tuo messaggio è stato inviato!</h2>
    </div>
@endif
@if ($errors->any() && !count(array_intersect($errors->all(),  [
                'These credentials do not match our records.',
                'The email has already been taken.',
                'The password must be at least 8 characters.',
                'The password confirmation does not match.'
            ])))
<div class="error-message message-animation">
    <ul>
        @foreach ($errors->all() as $error)
            @unless (in_array($error, [
                'These credentials do not match our records.',
                'The email has already been taken.',
                'The password must be at least 8 characters.',
                'The password confirmation does not match.'
            ]))
                <li><h2>{{ $error }}</h2></li>
            @endunless
        @endforeach
    </ul>
</div>
@endif
@include('shared.components.cardFlatShow')
@endsection
