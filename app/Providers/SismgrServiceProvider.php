<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App;

class SismgrServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        App::bind('Sismgr', function()
        {
            return new \App\Services\Sismgr\Sismgr;
        });
    }
}
