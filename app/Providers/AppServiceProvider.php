<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;


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
        //
        \Gate::define('isAdmin', function () {
            if (Auth::user()->auth_level == 9) {
                return true;
            } else {
                return false;
            }
        });
        \Gate::define('isManager', function () {
            if (Auth::user()->auth_level >= 7) {
                return true;
            } else {
                return false;
            }
        });
        \Gate::define('isWorker', function () {
            if (Auth::user()->auth_level >= 3) {
                return true;
            } else {
                return false;
            }
        });
        \Gate::define('isClient', function () {
            if (Auth::user()->auth_level >= 1) {
                return true;
            } else {
                return false;
            }
        });
        

    }
}
