<?php

namespace HackerspaceCRM\Menu\Repository;

use View;
use Illuminate\Support\ServiceProvider;

use HackerspaceCRM\Menu\Repository\MenuRepositoryInterface;
use HackerspaceCRM\Menu\Repository\EloquentMenuRepository;

class MenuRepositoryServiceProvider extends ServiceProvider
{
	/**
     * Register composer views.
     *
     * @return void
     */
	public function boot()
	{
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
