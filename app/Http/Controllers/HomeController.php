<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Flat;

class HomeController extends Controller
{
    public function index() {
        $activeSponsorships = DB::table('flat_sponsorship')
            ->where('end', '>=', date("Y-m-d H:i:s"))
            ->inRandomOrder()
            ->get();
        $sponsoredFlats = [];
        foreach($activeSponsorships as $activeSponsorship) {
            $sponsoredFlats[] = Flat::find($activeSponsorship->flat_id);
        }
        return view('guest.home', compact('sponsoredFlats'));
    }
}
