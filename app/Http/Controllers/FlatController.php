<?php

namespace App\Http\Controllers;
use App\Flat;

use Illuminate\Http\Request;


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
        $latlong = array_map(function($a) {return floatval($a);}, $latlong);
        //dd($latlong);
        $flatsInRange = [];
        foreach (Flat::all() as $flat) {
            if ($flat->getDistance($latlong) <= 20) {
                $flatsInRange[] = $flat;
            }
        }
        //dd(array_map(function($a) {return $a->id;}, $flatsInRange));
        //dd(Flat::all()->toArray());
        //dd(array_map(function($a) {return $a->getDistance([45.0678,  7.68249]);}, iterator_to_array(Flat::all())));
        return view('guest.flats.index', compact('flatsInRange'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Flat $flat)
    {
        return view('guest.flats.show', compact('flat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
