<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('ymddate', function ($expression) {
            list($date) = $expression;

            return \Carbon\Carbon::parse($date)->format('d-m-Y');
        });

        Blade::directive('ymdtimedate', function ($expression) {
            list($date) = $expression;

            return \Carbon\Carbon::parse($date)->format('d-m-Y').' pada '.\Carbon\Carbon::parse($date)->format('H:i');
        });

        Blade::directive('reportstatus', function ($expression) {
            list($status) = $expression;

            return $expression;

            // switch((int)$status) {
            //     case 0:
            //         return "Ditutup";
            //     break;
            //         case 1:
            //             return "Aktif";
            //         break;
            // }
        });
    }
}
