<?php

namespace HackerspaceCRM\Menu\Repository;

use View;
use Cache;
use Illuminate\Support\ServiceProvider;

use HackerspaceCRM\Menu\Menu;
use HackerspaceCRM\Menu\Repository\MenuRepositoryInterface;
use HackerspaceCRM\Menu\Repository\CacheableEloquentMenuRepository;
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
        // TEMPORARY SOLUTION
        Menu::updating(function ($menu) { $this->clearCache($menu->id); });
        Menu::creating(function ($menu) { $this->clearCache($menu->id);});
        Menu::deleting(function ($menu) { $this->clearCache($menu->id);});

		View::composer('includes.publicnavigation', 'HackerspaceCRM\Menu\Composers\PublicNavigation');
        View::composer('includes.mainnavigation', 'HackerspaceCRM\Menu\Composers\MainNavigation');
        View::composer('includes/settingsnavigation', 'HackerspaceCRM\Menu\Composers\SettingsNavigation');
	}

    /**
     * Register the service provider.
     */
    public function register()
    {
        // $this->app->bind(MenuRepositoryInterface::class, EloquentMenuRepository::class);
        $this->app->singleton(MenuRepositoryInterface::class, function() {
            return new CacheableEloquentMenuRepository(
                new EloquentMenuRepository,
                $this->app['cache.store']
            ); 
        });
    }

    private function clearCache($menuId)
    {
        Cache::forget('menus.all');
        Cache::forget('menus.byId.'.$menuId);
        foreach (crminfo('menu_groups') as $menugroup) {
            Cache::forget('menus.byGroup.'.$menugroup);
        }
    }
}
