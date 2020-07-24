<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Flat;
use Illuminate\Http\Request;

class devController extends Controller
{
    public function index() {
        $activeSponsorships = DB::table('flat_sponsorship')
            ->where('end', '>=', date("Y-m-d H:i:s"))
            ->inRandomOrder()
            ->get();
        $sponsoredFlats = $activeSponsorships->map(function ($item) {return Flat::find($item->flat_id);});
        return view('welcome', compact('sponsoredFlats'));
    }
}
