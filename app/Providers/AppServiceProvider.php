<?php

namespace App\Providers;

use Gate;
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
        
        Gate::define('admin', function(){
            if(Auth::user()->auth_level == 12){
                return true;
            }
            return false;
        });

        //
    }
}
