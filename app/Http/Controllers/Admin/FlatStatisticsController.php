<?php

namespace App\Http\Controllers\Admin;

use App\Flat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlatStatisticsController extends Controller
{
    function show(Flat $flat) {
        return Auth::id() == $flat->user_id ?
            view('admin.flats.flatStatistics', compact('flat')) :
            abort(403);
    }
}
