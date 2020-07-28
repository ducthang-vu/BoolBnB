@extends('layouts.main')


@section('page-content')
<div class="section-home-admin mt-20">
    @if ($errors->any())
    <div class="error-message message-animation">
        <ul>
            @foreach ($errors->all() as $error)
            <li>
                <h2>{{ $error }}</h2>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('flat-saved'))
    <div class="success-message message-animation">
        <h2>{{ session('flat-saved') }} aggiunto correttamente.</h2>
    </div>
    @endif
    @if (session('flat-deleted'))
    <div class="success-message message-animation">
        <h2>Appartamento n. {{ session('flat-deleted') }} eliminato correttamente.</h2>
    </div>
    @endif

    <div class="title-flts d-flex s-between align-center">
        <h1 class="mt-20 mb-20">
            Benvenuto {{Auth::user()->name}} {{Auth::user()->surname}}
        </h1>
        <a class="btn btn-add" href="{{ route('admin.flats.create') }}"><i class="fas fa-plus"></i></a>
    </div>

    <div class="info_card_admin d-flex">
        <div class="info-admin">
            <h3 class="mb-20">I tuoi dati</h3>
            <ul>
                <li>
                    <p class="mb-5 up_text">Nome completo:</p>
                    <p class="mb-20">{{Auth::user()->name}} {{Auth::user()->surname}}</p>
                </li>
                <li>
                    <p class="mb-5 up_text">Email:</p>
                    <p class="mb-20">{{Auth::user()->email}}</p>
                </li>
                <li>
                    <p class="mb-5 up_text">Data di nascita:</p>
                    <p class="mb-20">{{Auth::user()->date_of_birth}}</p>
                </li>
                <li>
                    <p class="mb-5 up_text">Inscritto dal: </p>
                    <p class="mb-20">{{Auth::user()->created_at}}</p>
                </li>
            </ul>
        </div>
        <div class="card-home_profile df-column align-center">
            <h3 class="mb-10">I tuoi appartamenti</h3>
            @if($flats->count())
            @foreach($flats as $flat)

            <a class="card @unless ($flat->is_active) opacity-05 @endunless"
                href="{{ route('admin.flats.show' , $flat->id) }}">
                <div class="image-card">
                    <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
                </div>

                <div class="text-card">
                    <h3 class="text-red mb-10 @if ($flat->is_active) no-display @endif">Attualmente non visibile nelle
                        ricerche
                        pubbliche</h3>
                    <h3 class="mb-10 mt-10">{{$flat->title}}</h3>
                    <p>Creato il: {{$flat->created_at}}</p>
                    <p class="mb-5">Ultima modifica: {{$flat->updated_at}}</p>
                </div>
            </a>
            @endforeach
            @else
            <h2>Inserisci un primo appartamento</h2> <a href="">Inserisci</a>
            @endif
        </div>

    </div>
    <div class="link-paginate">
        {{ $flats->links() }}
    </div>
</div>
@endsection