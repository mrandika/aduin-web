<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group(function () {
    Route::prefix('report')->group(function () {
        Route::get('index', 'API\User\ReportController@index');
        Route::post('store', 'API\User\ReportController@store');
        Route::get('show/{id}', 'API\User\ReportController@show');
        Route::post('support/{id}', 'API\User\ReportController@support');
        Route::post('unsupport/{id}', 'API\User\ReportController@unsupport');
        Route::post('comment/{id}', 'API\User\ReportController@comment');
        Route::delete('delete/comment/{id}', 'API\User\ReportController@destroy_comment');
        Route::patch('update/{id}', 'API\User\ReportController@update');
        Route::delete('delete/{id}', 'API\User\ReportController@destroy');
    });
});