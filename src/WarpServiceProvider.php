<?php

namespace Code16\Warp;

use Illuminate\Support\ServiceProvider;

class WarpServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        //
    }

    public function register()
    {   
        $this->app->singleton(Warp::class, function($app) {
            return new Warp;
        });
    }
}
