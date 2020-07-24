@extends('layouts.main')


@section('page-content')
@if(session('created'))
<div class="success-message message-animation">
    <p>Il tuo messaggio è stato inviato!</p>
</div>
@endif
@if ($errors->any())
<div class="error-message message-animation">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@include('shared.components.cardFlatShow')
@endsection