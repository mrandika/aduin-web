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

Route::prefix('user')->group(function () {
    // TODO ...
});

Route::prefix('admin')->group(function () {
    Route::prefix('report')->group(function () {
        Route::get('export/finished', 'Admin/ReportController@report_export');
    });
});

Auth::routes();
Route::post('/aduin/login', 'Auth\LoginController@aduin_login')->name('aduin.login');
Route::post('/register', 'Auth\RegisterController@aduin_register')->name('aduin.register');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('auth/google', 'Auth\Socialite\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\Socialite\GoogleController@handleGoogleCallback');
