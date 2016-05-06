<?php

namespace HackerspaceCRM\Menu\Repository;

use View;
use Illuminate\Support\ServiceProvider;

class MenuRepositoryServiceProvider extends ServiceProvider
{
	/**
     * Register composer views.
     *
     * @return void
     */
	public function boot()
	{

        // When caching menus:
        // Create here an event listener for when menu is updated to delete cache

		View::composer('includes.publicnavigation', 'HackerspaceCRM\Menu\Composers\PublicNavigation');
        View::composer('includes.mainnavigation', 'HackerspaceCRM\Menu\Composers\MainNavigation');
        View::composer('includes/settingsnavigation', 'HackerspaceCRM\Menu\Composers\SettingsNavigation');
	}

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind(MenuRepositoryInterface::class, EloquentMenuRepository::class);
    }
}
