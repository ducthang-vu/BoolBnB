<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

// Guest routes
Route::resource('flats', 'FlatController');
//Route::resource('requests', 'RequestController');

Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function(){
    Route::get('home_admin', 'HomeController@index')->name('home');
    Route::resource('flats', 'FlatController');
    Route::resource('sponsorships', 'SponsorshipController');
});

Route::get('search', 'FlatController@index')->name('search');


