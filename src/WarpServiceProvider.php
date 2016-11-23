<?php

namespace Dvlpp\Warp;

use Illuminate\Support\ServiceProvider;

class WarpServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        
    }

    public function register()
    {   
        $this->app->singleton(Warp::class, function($app) {
            // Retrieve Config, which is a user defined
            // Static data

            // Add CSRF Token
            
        });
    }
}
