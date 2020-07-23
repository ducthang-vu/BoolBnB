<?php

namespace App\Http\Controllers\Api;

use App\Flat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class FlatController extends Controller
{
    private function validateGet(Request $request)
    {
        return Validator::make($request->all(), [
            'rooms_min' => 'required|integer|min:1',
            'beds_min' => 'required|integer|min:1',
            'lat' => 'required|numeric|min:-90|max:90',
            'lng' => 'required|numeric|min:-180|max:180',
            'distance' => 'required|integer|min:1|max:40076',
            'required_services' => 'required|regex:/^(\d+-)*\d+$/',
        ]);
    }

    public function get(Request $request)
    {
        $result = [
            'error' => '',
            'number_records' => 0,
            'response' => []
        ];

        $result['error'] = $this->validateGet($request)->errors()->all();
        if ($result['error']) {
            return response()->json($result, 400);
        }

        //within distance
        $rawCollection = Flat::search()
            ->with([
                'aroundLatLng' => [floatval($request->lat), floatval($request->lng)],
                'aroundRadius' => 1000 * $request->distance,
                'filters' => 'number_of_beds >= ' . intval($request->beds_min) . ' ' .
                    'AND number_of_rooms >= ' . intval($request->rooms_min) . ' ' .
                    'AND is_active = 1',
                'hitsPerPage' => 1000
            ])
            ->get();

        //filter by services
        if ($request->required_services) {
            $services_required = collect(explode('-', $request->required_services));
            $rawCollection = $rawCollection->filter(function ($flat) use ($services_required) {
                return $services_required->every(function ($service) use ($flat) {
                    return  $flat->getServicesId()->contains($service);
                });
            })->sort(function ($a, $b) {
                return $a->hasActiveSponsorship() < $b->hasActiveSponsorship();
            })->flatten();
        }
        $rawCollection = $rawCollection->map(function ($item) {
            return $item->only(['id', 'title', 'description', 'address', 'image', 'lat', 'lng']);
        })->toArray();
        // $rawCollection = $rawCollection->map(function ($item) {
        //     $item->sponsored = $item->hasActiveSponsorship();
        // });
        // dd($rawCollection);
        $arrayCollection = array_map(function ($item) {
            $item['sponsored'] = Flat::find($item['id'])->hasActiveSponsorship();
            return $item;
        }, $rawCollection);

        dd($arrayCollection);
        $collection = $rawCollection->map(function ($item) {
            return $item->only(['id', 'title', 'description', 'address', 'image', 'lat', 'lng']);
        });
        $result['response'] = $collection->shuffle();
        $result['number_records'] = $collection->count();
        return response()->json($result);
    }
}
