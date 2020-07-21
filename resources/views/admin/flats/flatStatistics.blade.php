@extends('layouts.main')

@section('page-content')
{{--
    <div class="adminFlatStatistics">
        <h1>Statistiche appartamento #{{ $flat->id }}</h1>
        @dump($flat->visualisations->groupBy(function($item) {
    $date = Carbon\Carbon::parse($item->created_at);
    return $date->year . '-' . $date->month;
}))
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
    </div>
    --}}

    <div id="root" class="adminFlatStatistics">
    </div>
@endsection

<script>
    /*
    const visualisations = @{!! $flat->visualisations !!}
    const numberOrRequests = @{!! $flat->getNumberOfRequests() !!}
    */
</script>
