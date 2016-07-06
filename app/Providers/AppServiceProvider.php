<?php

namespace App\Providers;

use Blade;
use Validator;
// use App\Models\Menu;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
    {
        if ($this->app->isLocal()) {
            $kernel->pushMiddleware('App\Http\Middleware\FlushViews');
        }

        Validator::extend('no_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        Validator::extend('no_specials_lower_u', function($attr, $value){
            return preg_match('/^[a-z0-9_]+$/', $value);
        });

        Validator::extend('username', function($attr, $value){
            return preg_match('/^[A-Za-z0-9]+$/', $value);
        });

        Blade::directive('cache', function ($expression) {
            return "<?php if (! app('App\Models\BladeDirective')->setUp{$expression}) { ?>";
        });

        Blade::directive('endcache', function(){
            return "<?php } echo app('App\Models\BladeDirective')->tearDown(); ?>";
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(App\Models\BladeDirective::class);

        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
