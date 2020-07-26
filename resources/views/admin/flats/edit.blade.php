@extends('layouts.main')

@section('page-content')
    <div class="adminFlatsEdit mt-20">
        @if ($errors->any())
            <div class="error-message message-animation">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><h2>{{ $error }}</h2></li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="title-flts text-center">
            <h1 class="mt-20 mb-20">
                Aggiorna i dati dell'appartamento #{{$flat->id}}
            </h1>
        </div>

        @include('shared.components.formEdit')
    </div>
@endsection
