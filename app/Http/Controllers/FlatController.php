<?php

namespace App\Http\Controllers;
use App\Flat;
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
                'aroundLatLng' => array_map(function($a) {return floatval($a);}, $latlong),
                'aroundRadius' => 20000,
                'hitsPerPage' => 1000
            ])->get();
        return view('guest.flats.index', compact('flatsInRange', 'latlong'));
    }


    public function show(Flat $flat)
    {
        if (Auth::id() != $flat->user_id ) {
            DB::table('flats')->where('id', $flat->id)->increment('visualisations');
        }
        return view('guest.flats.show', compact('flat'));
    }
}
