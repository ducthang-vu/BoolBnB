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
    <div>
        <h1>Sponsorship for:</h1>
        <ul>
            <li>Flat #: {{ $flat->id }}</li>
            <li>Address: {{ $flat->address }}</li>
        </ul>
    </div>

    <form method="post" id="payment-form" action="{{ route('admin.sponsorships.store') }}">
        @csrf
        <section>
            {{--
            <label for="amount">
                <span class="input-label">Amount</span>
                <div class="input-wrapper amount-wrapper">
                    <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="10">
                </div>
            </label>
            --}}
            @foreach($sponsorships as $sponsorship)
                <div class="form-group">
                    <input
                        type="radio"
                        id="type-{{ $sponsorship->getHoursDurationAsStr() }}"
                        name="sponsorship_id"
                        value="{{ $sponsorship->id }}"
                    >
                    <label
                        for="type-getHoursDurationAsStr()"
                    >{{ $sponsorship->sponsor_type }}: € {{ $sponsorship->getPriceDecimallComma() }}
                    </label>
                </div>
            @endforeach

            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>

        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button" type="submit"><span>Test Transaction</span></button>
    </form>

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
