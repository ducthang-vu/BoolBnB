<?php

namespace App\Http\Controllers;

use App\Flat;
use App\Request as RequestFlat;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        //
        $request->validate([
            'flat_id' => 'required',
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:rfc,dns',
            'message' => 'required|max:5000',
        ]);
        // need validation of id flat
        if (!in_array($request->flat_id, Flat::all()->modelKeys())) {
            abort(404); // could be hadled better
        }
        $newRequest = new RequestFlat;
        $newRequest->fill($request->all());
        //dd($newRequest);
        if ($newRequest->save()) {
            return back()->with('created', true);
        }
    }
}
