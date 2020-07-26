@extends('layouts.main')


@section('page-content')
<div class="section-home-admin mt-20">
    @if ($errors->any())
        <div class="error-message message-animation">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><h2>{{ $error }}</h2></li>
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
            Benvenuto {{Auth::user()->surname}} {{Auth::user()->name}}, questi sono i tuoi appartamenti
        </h1>
        <a class="btn btn-add" href="{{ route('admin.flats.create') }}"><i class="fas fa-plus"></i></a>
    </div>
    @if($flats->count())
    @foreach($flats as $flat)
    <a class="card-row d-flex mb-10 @unless ($flat->is_active) opacity-05 @endunless"
        href="{{ route('admin.flats.show' , $flat->id) }}">
        <div class="image">
            <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
        </div>
        <div class="desc-card ml-10">
            <h3 class="text-red mb-10 @if ($flat->is_active) no-display @endif">Attualmente non visibile nelle ricerche
                pubbliche</h3>
            <h2 class="mb-10">{{$flat->title}}</h2>

            <p>{{$flat->description}}</p>
        </div>
    </a>
    @endforeach
    @else
    <h2>Inserisci un primo appartamento</h2> <a href="">Inserisci</a>
    @endif
    <div class="link-paginate">
        {{ $flats->links() }}
    </div>
</div>
@endsection
