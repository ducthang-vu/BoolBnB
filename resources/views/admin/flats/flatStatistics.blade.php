@extends('layouts.main')

@section('page-content')
    <h1>Statistiche appartamento #{{ $flat->id }}</h1>
    <div>
        <section>
            <h2>Visualizzazioni</h2>
            <h3>{{ $flat->visualisations }}</h3>
            <canvas id="chart-visualisations" width="400" height="400"></canvas>
        </section>

        <section>
            <h2>Messaggi ricevuti</h2>
            <h3>{{ $flat->getNumberOfRequests() }}</h3>
            <canvas id="chart-numberOfRequests" width="400" height="400"></canvas>
        </section>
    </div>
@endsection

<script>
    const visualisations = {!! $flat->visualisations !!}
    const numberOrRequests = {!! $flat->getNumberOfRequests() !!}
</script>
