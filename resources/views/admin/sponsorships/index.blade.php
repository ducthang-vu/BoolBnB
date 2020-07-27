@extends('layouts.main')

@section('page-content')
<div class="adminSponsorshipIndex">
    @if ($errors->any())
    <div class="error-message message-animation">
        <ul>
            @foreach ($errors->all() as $error)
                <li><h2>{{ $error }}</h2></li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('transactionId'))
        <div class="success-message message-animation">
            <h2>Payment made with id: {{ session('transactionId') }} </h2>
        </div>
    @endif
    @if ($sponsorships->count())
    <div class="pt-25 pb-25">
        <h1>Storico delle sponsorizzazioni</h1>
        <div class="mobile-sponsorship-page">
            @include ('admin.sponsorships.components.tableSponsorship')
        </div>
        <p class="table-note text-right mt-10">
            I righi verdi indicano sponsorizzazione attualmente attive.
        </p>
    </div>
    @else
    <h1 class="empty-h1-sponsorship-page p-50">
        * Non hai ancora nessun appartamento sponsorizzato.
    </h1>
    @endif
</div>
@endsection
