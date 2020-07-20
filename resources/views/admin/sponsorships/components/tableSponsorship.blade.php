<table class="table text-center mt-20">
    <thead>
        <tr class="head-row">
            <th scope="col">#</th>
            <th scope="col">Flat #</th>
            <th scope="col">Sponsorship</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
            <th scope="col">Price paid</th>
            <th scope="col">Payment code</th>
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
                <td scope="row">{{ $sponsorship->id }}</th>
                <td>{{ $sponsorship->flat_id }}</td>
                <td>{{ $sponsorship->sponsor_type }}</th>
                <td>{{ Carbon\Carbon::parse($sponsorship->start)->format('d/m/Y h:m') }}</td>
                <td>{{ Carbon\Carbon::parse($sponsorship->end)->format('d/m/Y h:m') }}</td>
                <td>{{ $sponsorship->price }}</td>
                <td>{{ $sponsorship->braintree_code }}</td>
            </tr>
        @endforeach
    </tbody>
</table>