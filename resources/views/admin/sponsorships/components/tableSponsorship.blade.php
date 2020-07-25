<table class="table text-center mt-20">
    <thead>
        <tr class="head-row">
            <th scope="col">Codice</th>
            <th scope="col">Appartamento</th>
            <th scope="col">Tipo</th>
            <th scope="col">Inizio</th>
            <th scope="col">Fine</th>
            <th scope="col">Prezzo</th>
            <th scope="col">Codice pagamento</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sponsorships as $sponsorship)
            <tr
                class="
                    @if (Carbon\Carbon::parse($sponsorship->end)
                            ->greaterThanOrEqualTo(Carbon\Carbon::now()))
                        active
                    @endif
                    "
            >
                <td scope="row" data-label="Codice">{{ $sponsorship->id }}</th>
                <td data-label="Appartamento">{{ $sponsorship->flat_id }}</td>
                <td data-label="Tipo">{{ $sponsorship->sponsor_type }}</th>
                <td data-label="Inizio">{{ Carbon\Carbon::parse($sponsorship->start)->format('d/m/Y h:m') }}</td>
                <td data-label="Fine">{{ Carbon\Carbon::parse($sponsorship->end)->format('d/m/Y h:m') }}</td>
                <td data-label="Prezzo">€ {{ $sponsorship->price }}</td>
                <td data-label="Codice pagamento">{{ $sponsorship->braintree_code }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
