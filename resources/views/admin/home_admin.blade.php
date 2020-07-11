@extends('layouts.main')


@section('page-content')

<div class="section-home-admin mt-20">
    @if (session('saved-flat'))
    <div>
        <p>{{ session('saved-flat') }} aggiunto correttamente.</p>
    </div>
    
    @endif

    <div class="title-flts d-flex s-between align-center">
        <h1 class="mt-20 mb-20">
            I tuoi appartamenti
        </h1>

        <a class="btn btn-add d-flex align-center" href="{{ route('admin.flats.create') }}">Inserisci</a>
    </div>
    

    @if($flats->count())

     @foreach($flats as $flat)
        <a class="card-row d-flex mb-10" href="{{ route('admin.flats.show' , $flat->id) }}">

            <img src="{{ asset('storage') . '/' . $flat->image}}" alt="{{$flat->title}}">

            <div class="desc-card ml-10">
                <h2 class="mb-10">{{$flat->title}}</h2>

                <p>{{$flat->description}}</p>
            </div>

            <div class="button-card mb-20 d-flex s-between">
                <div class="left-btn">
                    <a class="btn btn-spons mb-5" href="">Sponsorizza</a>
                    <a class="btn btn-edit mb-5" href="">Modifica</a>
                </div>
                
                <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input class="btn btn-delete" type="submit" value="Elimina">
                </form>
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