<?php

namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class MenusServiceProvider extends ServiceProvider
{

    /**
     * Register composer views.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('includes.mainnavigation', 'App\Composers\Menus\MainNavigation');
        View::composer('includes/settingsnavigation', 'App\Composers\Menus\SettingsNavigation');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
