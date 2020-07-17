@extends('layouts.main')

@section('page-content')
    <ul>
        @foreach($requests as $request)
            <li>
                <ul>
                    <li>{{ $request->id }}</li>
                    <li>{{ $request->surname }}</li>
                    <li>{{ $request->name }}</li>
                    <li>{{ $request->email }}</li>
                    <li>{{ $request->message }}</li>
                </ul>
            </li>
        @endforeach
    </ul>
@endsection
