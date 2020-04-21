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

Route::group(['prefix' => 'user',  'middleware' => 'people'], function() {
    Route::prefix('report')->group(function () {
        Route::post('store', 'User\ReportController@store');
        Route::get('show/{id}', 'User\ReportController@show')->name('report.show');
        Route::patch('update/{id}', 'User\ReportController@update');
        Route::delete('delete/{id}', 'User\ReportController@destroy');

        Route::prefix('comment')->group(function () {
            Route::post('store', 'User\ReportCommentController@store');
            Route::patch('update/{id}', 'User\ReportCommentController@update');
            Route::delete('delete/{id}', 'User\ReportCommentController@destroy');
        });
        
        Route::post('support/{id}', 'User\ReportController@support_report');
        Route::delete('unsupport/{id}', 'User\ReportController@unsupport_report');
    });
});

Route::group(['prefix' => 'admin',  'middleware' => 'admin'], function() {
    Route::get('', 'Admin\ReportController@index')->name('admin.home.statistic');
    Route::get('code/qr', 'Admin\ReportController@generate_qr');

    Route::prefix('report')->group(function () {
        Route::prefix('handler')->group(function () {
            Route::post('store', 'Admin\ReportHandlerController@store');
        });

        Route::prefix('action')->group(function () {
            Route::post('store', 'Admin\ReportActionController@store');
        });

        Route::get('export/finished', 'Admin\ReportController@report_export');
        Route::get('index/table', 'Admin\ReportController@report');

        Route::get('show/{id}', 'Admin\ReportController@show')->name('admin.report.show');
        Route::patch('update/{id}', 'Admin\ReportController@update')->name('admin.report.update');

        Route::get('unhandled', 'Admin\ReportController@index_unhandled')->name('admin.report.unhandled');
        Route::get('handled', 'Admin\ReportController@index_handled')->name('admin.report.handled');
        Route::get('finished', 'Admin\ReportController@index_finished')->name('admin.report.resolved');
    });
});

Route::group(['prefix' => 'handler',  'middleware' => 'handler'], function() {
    Route::get('', 'Handler\ReportController@index')->name('handler.home.statistic');

    Route::prefix('report')->group(function () {
        Route::get('show/{id}', 'Handler\ReportController@show')->name('handler.report.show');

        Route::prefix('action')->group(function () {
            Route::post('store', 'Handler\ReportActionController@store');
        });
    });

    Route::get('handled', 'Handler\ReportController@index_handled')->name('handler.report.handled');
    Route::get('finished', 'Handler\ReportController@index_finished')->name('handler.report.resolved');
});

if (env('APP_DEBUG')) {
    Route::get('debug/key', function() {
        dd([
            'ENCRYPTION_TOGGLE' => env('ADUIN_CRYPT_TOGGLE'),
            'ENCRYPTION_METHOD' => env('ADUIN_CRYPT_METHOD'),
            'MASTER_KEY' => env('ADUIN_MASTER_KEY'),
            'PUBLIC_KEY_PROPERTIES' => [
                'is_set' => env('ADUIN_PUBLIC_KEY') != null || env('ADUIN_PUBLIC_KEY') != '',
                'value' => env('ADUIN_PUBLIC_KEY')
            ],
            'PRIVATE_KEY_PROPERTIES' => [
                'is_set' => env('ADUIN_PRIVATE_KEY') != null || env('ADUIN_PRIVATE_KEY') != '',
                'value' => env('ADUIN_PRIVATE_KEY')
            ]
        ]);
    });
}

Auth::routes();
Route::post('/aduin/login', 'Auth\LoginController@aduin_login')->name('aduin.login');
Route::post('/register', 'Auth\RegisterController@aduin_register')->name('aduin.register');
Route::get('logout', 'Auth\LoginController@logout');
Route::get('auth/google', 'Auth\Socialite\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\Socialite\GoogleController@handleGoogleCallback');
