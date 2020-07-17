@extends('layouts.main')

@section('page-content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
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

    <form class="d-flex payment-form" method="post" id="payment-form" action="{{ route('admin.sponsorships.store') }}">
        @csrf
        <section class="braintree-form">
            {{--
            <label for="amount">
                <span class="input-label">Amount</span>
                <div class="input-wrapper amount-wrapper">
                    <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                </div>
            </label>
            --}}
            <ul class="form-group mb-10">
                @foreach($sponsorships as $sponsorship)
                <li>
                    <input class="radio" type="radio" id="type-{{ $sponsorship->getHoursDurationAsStr() }}"
                        name="sponsorship_id" value="{{ $sponsorship->id }}">
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
        <button class="button btn-transaction mt-20 mb-20" type="submit"><span>Test Transaction</span></button>
    </form>
</div>

<script src="https://js.braintreegateway.com/web/dropin/1.22.1/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#payment-form');
        var client_token = "{{ $token }}";

        braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            paypal: {
                flow: 'vault'
            }
        }, function (createErr, instance) {
            if (createErr) {
                console.log('Create Error', createErr);
                return;
            }
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                });
            });
        });
</script>
@endsection