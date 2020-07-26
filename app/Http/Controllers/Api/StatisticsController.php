<?php

namespace App\Http\Controllers\Api;

use App\Flat;
use Carbon\Carbon, Carbon\CarbonPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StatisticsController extends Controller
{
    private function createMonthsCounter(Carbon $start) {
        $months_array = Array_map(function($date) {
                return $date->year . ' - ' . $date->shortEnglishMonth;
            },
            CarbonPeriod::create($start, '1 month',  Carbon::today())->toArray());
        return collect(Array_fill_keys($months_array , 0));
    }

    private function getFieldCounter($field_collection, Carbon $start) {
        $raw_collection = $field_collection
            ->groupBy(function($item) {
                $date = Carbon::parse($item->created_at);
                return $date->year . ' - ' . $date->shortEnglishMonth;}
            )->toArray();
        uksort($raw_collection, function($a, $b) {
            return Carbon::parse($a)->greaterThan(Carbon::parse($b));
        });
        $collection = collect($raw_collection)->map(function ($item) {return collect($item)->count();});
        return $this->createMonthsCounter($start)->merge($collection);
    }

    public function get(Request $request) {
        $result = [
            'error' => '',
            'visualisations' => 0,
            'requests' => 0
        ];

        $result['error'] = Validator::make($request->all(), [
            'flat_id' => ['required', 'numeric', Rule::in(Flat::all()->modelKeys())],
        ])->errors()->all();
        if ($result['error']) {
            return response()->json($result, 400);
        }

        $flat = Flat::find($request->flat_id);
        $result['visualisations'] = $this->getFieldCounter($flat->visualisations, $flat->created_at);
        $result['requests'] = $this->getFieldCounter($flat->requests, $flat->created_at);
        return response()->json($result);
    }
}
