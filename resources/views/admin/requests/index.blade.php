@extends('layouts.main')

@section('page-content')
<h1 class="mt-20 mb-10">Messaggi ricevuti</h1>
<p class="mb-20">Hai ricevuto {{$requests->count() }} messaggi</p>
<div class="requestsIndex-page mb-30">
    @foreach($requests as $request)
    <div class="request-card pt-40 pb-15 pl-10 pr-10">
        <ul>
            <li class="mb-5">
                ID Appartamento: {{ $request->flat_id }}
            </li>
            <li class="mb-5">
                <strong>{{ $request->name }} {{ $request->surname }}</strong>
            </li>
            <li class="mb-10">
                {{ $request->email }}
            </li>
            <li class="text-right mb-5 request-date">
                {{ Carbon\Carbon::parse($request->created_at)->format('d/m/Y h:m') }}
            </li>
        </ul>
        <p class="l-height-150 no-display message-text pt-25">{{ $request->message }}</p>
    </div>
    @endforeach
</div>
@endsection