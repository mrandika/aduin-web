<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/location', function () {
    $data = \Location::get('103.57.36.223');

    dd($data);
});

Route::get('/data/district', function() {
    $province = \App\Model\Master\Zone\Province::where('id', 11)->with('districts')->get();
    dd($province);
});

Route::prefix('user')->group(function () {
    Route::get('', 'User\HomeController@index')->name('user.index');
});

Auth::routes();
Route::get('auth/google', 'Auth\Socialite\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\Socialite\GoogleController@handleGoogleCallback');
