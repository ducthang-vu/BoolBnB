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
    <div class="container p-25">
        <a class="btn-sponsorship-index-page" href="{{ route('admin.home') }}">Go back to flat list</a>
        <div class="mobile-sponsorship-page">
            @include ('admin.sponsorships.components.tableSponsorship')
        </div>
        <div class="desktop-sponsorship-page">
            @include ('admin.sponsorships.components.tableSponsorship')
        </div>

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
