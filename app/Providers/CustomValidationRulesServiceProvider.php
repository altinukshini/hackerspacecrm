<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class CustomValidationRulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
    {
        Validator::extend('no_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });

        Validator::extend('no_specials_lower_u', function ($attr, $value) {
            return preg_match('/^[a-z0-9_]+$/', $value);
        });

        Validator::extend('username', function ($attr, $value) {
            return preg_match('/^[A-Za-z0-9]+$/', $value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
