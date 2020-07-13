@extends('layouts.main')


@section('page-content')
    <div class="section-home-admin mt-20">
        @if (session('flat-saved'))
        <div>
            <p>{{ session('flat-saved') }} aggiunto correttamente.</p>
        </div> 
        @endif
        @if (session('flat-deleted'))
        <div>
            <p>Appartamento n. {{ session('flat-deleted') }} eliminato correttamente.</p>
        </div>

        @endif

        <div class="title-flts d-flex s-between align-center">
            <h1 class="mt-20 mb-20">
                I tuoi appartamenti
            </h1>

            <a class="btn btn-add" href="{{ route('admin.flats.create') }}"><i class="fas fa-plus"></i></a>
        </div>


        @if($flats->count())

        @foreach($flats as $flat)
                <a class="card-row d-flex mb-10" href="{{ route('admin.flats.show' , $flat->id) }}">
                    <div class="image">
                        @if (!empty($flat->image))
                            <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
                        @else
                            <img src="https://i.ibb.co/bRN3hZD/casa.jpg" alt="casa">
                        @endif
                    </div>
                    

                    <div class="desc-card ml-10">
                        <h2 class="mb-10">{{$flat->title}}</h2>

                        <p>{{$flat->description}}</p>
                    </div>

                    <div class="button-card mb-20 d-flex">
                        <div class="left-btn">
                            <a class="btn btn-spons mb-5" href="{{ route('admin.sponsorships.create', ['flat_id' => $flat->id]) }}">Sponsorizza</a>
                            <a class="btn btn-edit mb-5" href="{{ route('admin.flats.edit', $flat->id) }}">Modifica</a>
                            <form action="{{ route('admin.flats.destroy', $flat->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-delete" type="submit" value="Elimina">
                            </form>
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