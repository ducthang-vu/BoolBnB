@extends('layouts.main')

@section('page-content')
<div class="section-home-admin mt-20">
    <div class="title-flts text-center">
        <h1 class="mt-20 mb-10">
            Aggiungi un appartamento
        </h1>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger error-message">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @include('shared.components.formCreate')

</div>
@endsection