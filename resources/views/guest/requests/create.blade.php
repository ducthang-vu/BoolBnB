@extends('layouts.main')

@section('page-content')
    {{-- CARD --}}

    <form action="{{ route('requests.store') }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="title">Cognome</label>
            <input
                type="text"
                class="form-control"
                name="surname"
                id="surname"
                value="{{ old('title') }}"
            >
        </div>

        <div class="form-group">
            <label for="title">Nome</label>
            <input
                type="text"
                class="form-control"
                name="name"
                id="name"
                value="{{ old('title') }}"
            >
        </div>

        <div class="form-group">
            <label for="title">Email</label>
            <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                value="{{ old('title') }}"
            >
        </div>

        <div class="form-group">
            <label for="body">Message</label>
            <textarea
                name="message"
                id="message"
                cols="30"
                rows="10"
                class="form-control"
            >
                {{ old('body') }}
            </textarea>
        </div>

        <input
            type="hidden"
            class="form-control"
            name="flat_id"
            id="flat_id"
            value="{{ $flat->id }}"
        >
        <input type="submit" value="Create">
@endsection
