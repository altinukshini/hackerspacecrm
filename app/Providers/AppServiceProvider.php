<?php

namespace App\Providers;

use Blade;
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
