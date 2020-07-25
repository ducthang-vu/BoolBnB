@extends('layouts.main')

@section('page-content')
<div class="adminSponsorshipIndex">
    @if ($errors->any())
    <div class="error-message">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('transactionId'))
    <div class="success-message">
        <strong>Payment made with id: #{{ session('transactionId') }} </strong>
    </div>
    @endif
    @if ($sponsorships->count())
    <div class="pt-25 pb-25">
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
