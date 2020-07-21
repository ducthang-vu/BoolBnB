<?php

namespace App\Http\Controllers\Api;

use App\Flat;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StatisticsController extends Controller
{
    private function getFieldByYearMonth($id, $field_collection) {
        $raw_collection = $field_collection
            ->groupBy(function($item) {
                $date = Carbon::parse($item->created_at);
                return $date->year . ' - ' . $date->shortEnglishMonth;}
            )->toArray();
        uksort($raw_collection, function($a, $b) {
            $dateA = Carbon::parse($a);
            $dateB = Carbon::parse($b);
            return $dateA->greaterThan($dateB);
        });
        return collect($raw_collection)->map(function ($item) {return collect($item)->count();});
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
        $result['visualisations'] = $this->getFieldByYearMonth($flat->id, $flat->visualisations);
        $result['requests'] = $this->getFieldByYearMonth($flat->id, $flat->requests);
        return response()->json($result);
    }
}
