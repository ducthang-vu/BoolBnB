@extends('layouts.main')


@section('page-content')

<div class="section-home-admin mt-20">
    <div class="d-flex s-center transition-invisible">

        @if (session('flat-saved'))
        <div class="success-message">
            <p>{{ session('flat-saved') }} Aggiunto correttamente.</p>
        </div>
        @endif
        @if (session('flat-deleted'))
        <div class="success-message">
            <p>Appartamento n. {{ session('flat-deleted') }} Eliminato correttamente.</p>
        </div>

        @endif
    </div>

    <div class="title-flts d-flex s-between align-center">

        <h1 class="mt-20 mb-20">
            Bentornato {{Auth::user()->surname}} {{Auth::user()->name}}, questi sono i tuoi appartamenti
        </h1>

        <a class="btn btn-add" href="{{ route('admin.flats.create') }}"><i class="fas fa-plus"></i></a>
    </div>

    @if($flats->count())
        @foreach($flats as $flat)
        <a class="card-row d-flex mb-10" href="{{ route('admin.flats.show' , $flat->id) }}">
            <div class="image">
                <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
            </div>

            <div class="desc-card ml-10">
                <h2 class="mb-10">{{$flat->title}}</h2>

                <p>{{$flat->description}}</p>
            </div>

            <div class="button-card mb-20 d-flex">
                <div class="left-btn d-flex">
                    <a class="btn btn-stat mb-5 mr-5" href="{{ route('admin.statistics' , $flat->id) }}"><i
                            class="far fa-chart-bar"></i><span class="top-text">Statistiche</span></a>
                    <a class="btn btn-spons mb-5 mr-5"
                        href="{{ route('admin.sponsorships.create', ['flat_id' => $flat->id]) }}"><i
                            class="fas fa-medal"></i><span class="top-text">Sponsorizza</span></a>
                    <a class="btn btn-edit mb-5 mr-5" href="{{ route('admin.flats.edit', $flat->id) }}"><i
                            class="far fa-edit"></i><span class="top-text">Modifica</span></a>
                    <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete"><i class="far fa-trash-alt"></i><span
                                class="top-text">Elimina</span></button>
                    </form>
                    {{-- <button class="btn btn-"><i class="far fa-arrow-alt-circle-right"></i></button> --}}
                </div>
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
