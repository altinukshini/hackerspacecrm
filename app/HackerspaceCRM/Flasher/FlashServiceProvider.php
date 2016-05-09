<?php

namespace HackerspaceCRM\Flasher;

use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider
{
	
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
	public function boot()
	{
		
	}

	/**
     * Register the application services.
     *
     * @return void
     */
	public function register()
	{
		$this->app->bind('flash', function()
		{
			return $this->app->make('HackerspaceCRM\Flasher\FlashNotifier');
		});
	}
}