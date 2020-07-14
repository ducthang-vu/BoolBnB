<?php

namespace App\Http\Controllers\Admin;

use App\Flat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlatStatisticsController extends Controller
{
    function show(Flat $flat) {
        return view('admin.flats.flatStatistics', compact('flat'));
    }
}
