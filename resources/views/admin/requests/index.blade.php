@extends('layouts.main')

@section('page-content')
<h1 class="m-20">Richieste ricevute</h1>
<div class="requestsIndex-page">
    @foreach($requests as $request)
    <div class="request-card d-flex p-20">
        <div class="request-details">
            <h3>ID Richiesta: {{ $request->id }}</h3>
            <h4>ID Appartamento: {{ $request->flat_id }}</h4>
            <h4>Ricevuta da:
                <span class="request-text">{{ $request->name }} {{ $request->surname }}</span>
            </h4>
            <h4>Ricevuto il: <span
                    class="request-text">{{ Carbon\Carbon::parse($request->created_at)->format('d/m/Y h:m') }}</span>
            </h4>
            <h4>Email: <span class="request-text">{{ $request->email }}</span></h4>
        </div>
        <div class="request-message-handler">
            <h4 class="message-control active text-center">Mostra Messaggio:</h4>
            <h4 class="message-control text-center">Nascondi Messaggio</h4>
            <p class="request-message">{{ $request->message }}</p>
        </div>
    </div>
    @endforeach
</div>
@endsection