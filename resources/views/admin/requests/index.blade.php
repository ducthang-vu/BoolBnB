@extends('layouts.main')


@section('page-content')
    @foreach($requests as $request)
        {{ $request }}
    @endforeach
@endsection
