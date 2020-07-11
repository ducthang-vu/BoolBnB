@extends('layouts.main')

@section('page-content')
    <a href="{{ route('admin.home') }}">Go back to flat list</a>
    <table class="table">
        <thead>
        <tr>
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
            <tr>
                <th scope="row">{{ $sponsorship->id }}</th>
                <td>{{ $sponsorship->flat_id }}</td>
                <th>{{ $sponsorship->sponsor_type }}</th>
                <td>{{ $sponsorship->start }}</td>
                <td>{{ $sponsorship->end }}</td>
                <td>{{ $sponsorship->price }}</td>
                <td>{{ $sponsorship->braintree_code }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
