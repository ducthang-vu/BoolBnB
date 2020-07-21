@extends('layouts.main')


@section('page-content')
    @if(session('created'))
        <div class="alert alert-success transition-invisible success-message">
            <p>Your message have been sent to the host!</p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('shared.components.cardShow')
@endsection
