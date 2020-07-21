@extends('layouts.main')

@section('page-content')
    <div class="section-home-admin mt-20">
        <div class="title-flts text-center">
            <h1 class="mt-20 mb-20">
                Aggiorna i dati dell'appartamento #{{$flat->id}}
            </h1>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger error-message">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @include('shared.components.formEdit')
    </div>
@endsection
