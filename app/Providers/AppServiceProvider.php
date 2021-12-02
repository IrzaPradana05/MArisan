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
        date_default_timezone_set('Asia/Jakarta');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('roleCanAccess', function($role) {
            $roleUser = auth()->user()->role;
            
            if(! is_array($role)) {
                if($role == $roleUser) return true;
                return false;
            }

            return \in_array($roleUser, $role);
        });
    }
}
