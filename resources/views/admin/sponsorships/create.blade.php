@extends('layouts.main')

@section('page-content')
<div class="adminSponsorshipsCreate">
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

    <header class="flatPagesHeader mb-25">
        <a class="anchor" href="{{ route('admin.flats.show' , $flat->id) }}">Appartamento # {{ $flat->id}}</a>
        <i class="fas fa-chevron-right"></i>
        <span>Nuova sponsorizzazione</span>
    </header>
    <div class="createSponsorship-page d-flex">
        <a href="{{ route('admin.flats.show', $flat->id) }}">
            <div id="search-cards" class="search-cards">
                <div class="card-row d-flex">
                    <div class="image">
                        @if (!empty($flat->image))
                        <img src="{{ asset('storage/' . $flat->image ) }}" alt="{{$flat -> title}}">
                        @else
                        <img src="https://i.ibb.co/bRN3hZD/casa.jpg" alt="casa">
                        @endif
                    </div>
                    <div class="desc-card ml-10">
                        <h2 class="mb-10">{{$flat->title}}</h2>
                        <p>{{$flat->address}}</p>
                    </div>
                </div>
            </div>
        </a>

        <form class="d-flex payment-form" method="post" id="payment-form"
            action="{{ route('admin.sponsorships.store') }}">
            @csrf
            <section class="braintree-form">
                <ul class="form-group mb-10">
                    @foreach($sponsorships as $sponsorship)
                    <li>
                        <input class="radio" type="radio" id="type-{{ $sponsorship->getHoursDurationAsStr() }}"
                            name="sponsorship_id" value="{{ $sponsorship->id }}"
                            @if($sponsorship->getHoursDurationAsStr() == 144) checked @endif>
                        <label class="radio-label"
                            for="type-{{ $sponsorship->getHoursDurationAsStr() }}">{{ $sponsorship->sponsor_type }}: €
                            {{ $sponsorship->getPriceDecimallComma() }}
                        </label>
                    </li>
                    @endforeach
                </ul>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <div class="d-flex s-center w-100">
                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="button btn-transaction mt-20 mb-20" type="submit"><span>Effettua pagamento</span></button>
            </div>
        </form>
    </div>
</div>
<script>
    const client_token = "{{ $token }}";
</script>
@endsection
