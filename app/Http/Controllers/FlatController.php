<?php

namespace App\Http\Controllers;
use App\Flat;
use Illuminate\Http\Request;
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
        // $latlong = explode(',', $request->input('latlong'));
        // //dd($latlong);
        // $latlong = array_map(function($a) {return floatval($a);}, $latlong);
        // //dd($latlong);
        // $flatsInRange = [];
        // foreach (Flat::all() as $flat) {
        //     if ($flat->getDistance($latlong) <= 40) {
        //         $flatsInRange[] = $flat;
        //     }
        // }
        //dd(array_map(function($a) {return $a->id;}, $flatsInRange));
        //dd(Flat::all()->toArray());
        //dd(array_map(function($a) {return $a->getDistance([45.0678,  7.68249]);}, iterator_to_array(Flat::all())));

        $query = $request->all();
        $latlong = explode(',', $request->input('latlong'));
        $latlong = array_map(function($a) {return floatval($a);}, $latlong);
        // dd($latlong);

        $flatsInRange = Flat::search()
        ->with([
            'aroundLatLng' => $latlong,
            'aroundRadius' => 20000,
            'hitsPerPage' => 1000
        ])->get();

        return view('guest.flats.index', compact('flatsInRange', 'latlong'));
    }


    public function show(Flat $flat)
    {
        DB::table('flats')->where('id', $flat->id)->increment('visualisations');
        return view('guest.flats.show', compact('flat'));
    }
}
