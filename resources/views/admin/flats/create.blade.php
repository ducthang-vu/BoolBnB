@extends('layouts.main')

@section('page-content')
    <div class="section-home-admin mt-20">
        <div class="title-flts d-flex s-between align-center">
            <h1 class="mt-20 mb-20">
                Aggiungi un appartamento
            </h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
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
