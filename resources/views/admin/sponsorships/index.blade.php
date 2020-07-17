@extends('layouts.main')

@section('page-content')
    <div class="adminSponsorshipIndex">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('transactionId'))
            <div class="alert alert-success position-absolute container p-3 transition-invisible">
                <strong>Payment made with id: #{{ session('transactionId') }} </strong>
            </div>
        @endif
        @if ($sponsorships->count())
            <div class="container p-25">
                <a class="btn-sponsorship-index-page" href="{{ route('admin.home') }}">Go back to flat list</a>
                <table class="table text-center">
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
                <div class="active-legend-div-indexSponsorship-page">
                    <div class="greendiv-indexSponsorship-page"><i class="fas fa-circle"></i></div>
                    <span class="span-indexSponsorship-page">= la sponsorizzazione è attiva</span>
                </div>
            </div>
        @else
            <h1 class="empty-h1-sponsorship-page p-50">
                Non hai ancora nessun appartamento sponsorizzato.
            </h1>
        @endif
    </div>
@endsection
