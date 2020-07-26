@extends('layouts.main')


@section('page-content')
@if(session('created'))
    <div class="success-message message-animation">
        <h2>Il tuo messaggio è stato inviato!</h2>
    </div>
@endif
@if ($errors->any())
<div class="error-message message-animation">
    <ul>
        @foreach ($errors->all() as $error)
        <li><h2>{{ $error }}</h2></li>
        @endforeach
    </ul>
</div>
@endif
@include('shared.components.cardFlatShow')
@endsection
