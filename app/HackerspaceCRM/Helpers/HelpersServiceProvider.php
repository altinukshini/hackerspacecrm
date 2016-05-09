<?php

namespace HackerspaceCRM\Helpers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        foreach (glob(app_path().'/HackerspaceCRM/Helpers/Functions/*.php') as $filename) {
            require_once $filename;
        }
    }
}
