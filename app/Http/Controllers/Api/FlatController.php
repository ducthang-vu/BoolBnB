<?php

namespace App\Http\Controllers\Api;

use App\Flat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    private function validateGet(Request $request) {
        /*
         * Request object must have:
         * - rooms_min
         * - beds_min
         * - required_services - string with following format: 1-12-3, numbers are service_id from services table; use 0
         *                          when no services are required
         * - lat,
         * - lng
         * - distance (km)
         */
        $errors = [];
        if (!$request->filled ('rooms_min', 'beds_min', 'required_services', 'lat', 'lng', 'distance')) {
            $errors[] = 'Missing parameters.' .
                'The following parameters must be filled: rooms_min, beds_min, required_services, lat, lng, distance.';
        }
        if ($request->rooms_min < 1 ||
            $request->beds_min < 1 ||
            $request->lat < -90 || $request->lat > 90 ||
            $request->lng < -180 || $request->lng > 180 ||
            $request->distance < 1 || $request->distance > 40076 ||
            !preg_match('/^(\d+-)*\d+$/', $request->required_services)) {
            $errors[] = 'Parameter(s) not allowed.';
        }
        return $errors;
    }

    public function get(Request $request) {
        $result = [
            'error' => '',
            'number_records' => 0,
            'response' => []
        ];

        $result['error'] = $this->validateGet($request);
        if (!empty($result['error'])) return response()->json($result, 400);

        //within distance
        $collection = Flat::search()
            ->with([
                'aroundLatLng' => [floatval($request->lat), floatval($request->lng)],
                'aroundRadius' => 1000 * $request->distance,
                'filters' => 'number_of_beds >= ' . intval($request->beds_min) . ' ' .
                            'AND number_of_rooms >= ' . intval($request->rooms_min),
                'hitsPerPage' => 1000
            ])
            ->get();

        if ($request->required_services) {
            $services_required = collect(explode('-', $request->required_services));
            $collection = $collection->filter(function($flat) use ($services_required) {
                return $services_required->every(function($service) use ($flat) {
                    return  $flat->getServicesId()->contains($service);
                })
            ;});
        }

        $result['response'] = $collection;
        $result['number_records'] = $collection->count();
        return response()->json($result);
    }
}
