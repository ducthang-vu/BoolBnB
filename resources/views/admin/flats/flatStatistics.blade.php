@extends('layouts.main')

@section('page-content')
<div id="root" class="adminFlatStatistics">
</div>
<a class="btn-link in-block mb-20" href="{{ route('admin.flats.show' , $flat->id) }}">Torna all'appartamento</a>
@endsection