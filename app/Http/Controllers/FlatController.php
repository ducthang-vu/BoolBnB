<?php

namespace App\Http\Controllers;

use App\Flat;
use App\Visualisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $latlong = explode(',', $request->input('latlong'));
        $flatsInRange = Flat::search()->with([
            'aroundLatLng' => array_map(function ($a) {
                return floatval($a);
            }, $latlong),
            'aroundRadius' => 20000,
            'hitsPerPage' => 1000
        ])->where('is_active', 1)->get()->toArray();
        $flatsInRange = array_map(function ($item) {
            $item['sponsored'] = Flat::find($item['id'])->hasActiveSponsorship();
            return $item;
        }, $flatsInRange);
        $splitCollection = [
            'sponsored' => [],
            'not_sponsored' => []
        ];
        foreach ($flatsInRange as $flat) {
            $flat['sponsored'] ? $splitCollection['sponsored'][] = $flat : $splitCollection['not_sponsored'][] = $flat;
        }
        $flatsInRange = array_merge($splitCollection['sponsored'], $splitCollection['not_sponsored']);
        return view('guest.flats.index', compact('flatsInRange', 'latlong'));
    }


    public function show(Flat $flat)
    {
        if (!$flat->is_active) return abort('404');
        if (Auth::check() && Auth::id() != $flat->user_id) {
            $newVisualisation = new Visualisation();
            $newVisualisation->flat_id = $flat->id;
            $newVisualisation->save();
        }
        return view('guest.flats.show', compact('flat'));
    }
}
