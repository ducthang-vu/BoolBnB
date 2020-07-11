<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Flat;
use App\Request as RequestFlat;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Flat $flat)
    {
        return view('guest.requests.create', ['flat' => $flat]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request)
        $request->validate([
            'flat_id' => 'required',
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:rfc,dns',
            'message' => 'required|max:5000',
        ]);
        // need validation of id flat
        $data = $request->all();

        $newRequest = new RequestFlat;
        $newRequest->fill($data);
        $saved = $newRequest->save();

        if ($saved) {
            return redirect()->route('flats.show', $data->flat_id)->with('created', true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
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
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort(404);
    }
}
