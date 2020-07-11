@extends('layouts.main')

@section('page-content')
    <ul>
        @foreach($sponsorships as $sponsorship)
            <li>
                {{ $sponsorship->id }}
            </li>
        @endforeach
    </ul>
@endsection
