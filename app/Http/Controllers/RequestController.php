<?php

namespace App\Http\Controllers;

use App\Flat;
use App\Request as RequestFlat;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'flat_id' => ['required', Rule::in(Flat::all()->modelKeys())],
            'surname' => 'required|max:255',
            'name' => 'required|max:255',
            'email' => 'required|max:255|email:rfc,dns',
            'message' => 'required|max:5000',
        ]);
        $newRequest = new RequestFlat;
        $newRequest->fill($request->all());
        if ($newRequest->save()) {
            return back()->with('created', true);
        }
    }
}
