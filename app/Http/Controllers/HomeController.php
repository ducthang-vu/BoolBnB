<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
        $activeSponsorships = DB::table('flat_sponsorship')
            ->where('end', '>=', date("Y-m-d H:i:s"))
            ->inRandomOrder()
            ->get();
        return view('guest.home', compact('activeSponsorships'));
    }
}
