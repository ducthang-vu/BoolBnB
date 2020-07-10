<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Flat;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index() {
        
        $flats = Flat::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(5);

        return view('admin.home_admin', compact('flats'));

    }
    
}
