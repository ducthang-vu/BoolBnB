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
Route::resource('flats', 'FlatController')->only(['index', 'show']);
Route::post('flats/requests', 'RequestController@store')->name('requests');

// Admin route
Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('home_admin', 'HomeController@index')->name('home');
        Route::get('flats/{flat}/statistics', 'FlatStatisticsController@show')->name('statistics');
        Route::resource('flats', 'FlatController');
        Route::resource('requests', 'RequestController');
        Route::resource('sponsorships', 'SponsorshipController')->only(['index', 'create', 'store']);
    });

Route::get('dev', function () {
    return view('shared.components.formAlgoliaHome');
});

Route::get('dev', function () {
    return view('welcome');
});
