@extends('layouts.main')

@section('page-content')
    <div class="adminSponsorshipsCreate">
        @if ($errors->any())
            <div class="error-message message-animation">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><h2>{{ $error }}</h2></li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1 class="mt-30 mb-30">Sponsorship for:</h1>
        <div class="createSponsorship-page d-flex">
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

            <form
                class="d-flex payment-form"
                method="post" id="payment-form"
                action="{{ route('admin.sponsorships.store') }}">
                @csrf
                <section class="braintree-form">
                    <ul class="form-group mb-10">
                        @foreach($sponsorships as $sponsorship)
                            <li>
                                <input
                                    class="radio"
                                    type="radio"
                                    id="type-{{ $sponsorship->getHoursDurationAsStr() }}"
                                    name="sponsorship_id" value="{{ $sponsorship->id }}"
                                    @if ($sponsorship->getHoursDurationAsStr() == 144) checked @endif
                                >
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

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="button btn-transaction mt-20 mb-20" type="submit"><span>Make transaction</span></button>
            </form>
        </div>
    </div>

    <script>
        const client_token = "{{ $token }}";
    </script>
@endsection
