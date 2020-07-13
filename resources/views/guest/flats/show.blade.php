@extends('layouts.main')


@section('page-content')
    @if(session('created'))
        <div class="alert alert-success transition-invisible">
            <p>Your message have been sent to the host!</p>
        </div>
    @endif
    @include('shared.components.cardShow')

@endsection
