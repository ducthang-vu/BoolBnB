@extends('layouts.main')

@section('page-content')
    @if ($errors->any())
        <div class="error-message message-animation">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><h2>{{ $error }}</h2></li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="section-home-admin mt-20">
        <div class="title-flts text-center">
            <h1 class="mt-20 mb-10">
                Aggiungi un appartamento
            </h1>
        </div>

        @include('shared.components.formCreate')

    </div>
@endsection
